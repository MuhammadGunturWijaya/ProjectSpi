<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use Illuminate\Support\Facades\Log;

class SurveyController extends Controller
{
    public function index()
    {
        return view('SurveyKepuasan.Survey-Kepuasan');
    }

    public function store(Request $request)
    {
        try {
            // Ambil semua pertanyaan
            $allQuestions = SurveyQuestion::orderBy('order')->get();

            // ✅ Validasi data demografi
            $validated = $request->validate([
                'jenis_kelamin' => 'required|string',
                'pendidikan' => 'required|string',
                'pekerjaan' => 'required|string',
                'tanggal' => 'required|date',
                'kendala' => 'nullable|string',
                'saran' => 'nullable|string',
            ]);

            // ✅ Proses jawaban - semua pertanyaan menggunakan format jawaban[index]
            $answers = [];
            
            foreach ($allQuestions as $index => $question) {
                $jawabanValue = $request->input("jawaban.{$index}");
                
                // ✅ Validasi setiap jawaban harus ada
                if (empty($jawabanValue)) {
                    return back()->withErrors([
                        'jawaban' => "Pertanyaan nomor " . ($index + 1) . " harus dijawab."
                    ])->withInput();
                }
                
                $answers[$question->id] = [
                    'pertanyaan' => $question->question_text,
                    'jawaban' => $jawabanValue
                ];
            }

            // ✅ Debug log (opsional, untuk troubleshooting)
            Log::info('Survey Data:', [
                'email' => Auth::user()->email,
                'answers_count' => count($answers),
                'validated' => $validated
            ]);

            // ✅ Simpan ke database
            Survey::create([
                'email' => Auth::user()->email,
                'tanggal' => $validated['tanggal'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'pendidikan' => $validated['pendidikan'],
                'pekerjaan' => $validated['pekerjaan'],
                'jawaban' => json_encode($answers),
                'kendala' => $validated['kendala'] ?? null,
                'saran' => $validated['saran'] ?? null,
            ]);

            return back()->with('survey_success', 'Terima kasih telah mengisi survey!');

        } catch (\Exception $e) {
            Log::error('Survey Error: ' . $e->getMessage());
            return back()->withErrors([
                'error' => 'Terjadi kesalahan saat menyimpan survey. Silakan coba lagi.'
            ])->withInput();
        }
    }

    public function showAll()
    {
        // Ambil semua survey dan pertanyaan
        $surveys = Survey::latest()->get();
        $questions = SurveyQuestion::orderBy('order')->get();

        // Label otomatis Q1, Q2, dst
        $questionLabels = [];
        for ($i = 1; $i <= $questions->count(); $i++) {
            $questionLabels[] = "Q{$i}";
        }

        // ✅ Hitung rata-rata skor per pertanyaan
        $criteriaScores = [];

        foreach ($questions as $question) {
            $totalScore = 0;
            $count = 0;

            foreach ($surveys as $survey) {
                // FIX: Pastikan jawaban adalah array
                $jawaban = $this->decodeJsonSafely($survey->jawaban);

                if (!empty($jawaban[$question->id]['jawaban'])) {
                    $value = match ($jawaban[$question->id]['jawaban']) {
                        'Sangat Puas' => 5,
                        'Puas' => 4,
                        'Cukup Puas' => 3,
                        'Kurang Puas' => 1,
                        default => 0,
                    };
                    $totalScore += $value;
                    $count++;
                }
            }

            $criteriaScores[] = $count > 0 ? round($totalScore / $count, 2) : 0;
        }

        // ✅ Distribusi Kepuasan (pie chart)
        $dataKepuasan = [
            'Sangat Puas' => 0,
            'Puas' => 0,
            'Cukup Puas' => 0,
            'Kurang Puas' => 0,
        ];

        foreach ($surveys as $survey) {
            // FIX: Pastikan jawaban adalah array
            $jawaban = $this->decodeJsonSafely($survey->jawaban);
            
            foreach ($jawaban as $item) {
                if (!empty($item['jawaban']) && isset($dataKepuasan[$item['jawaban']])) {
                    $dataKepuasan[$item['jawaban']]++;
                }
            }
        }

        // ✅ Kirim semua data ke view
        return view('SurveyKepuasan.lihat-survey', compact(
            'surveys',
            'questions',
            'questionLabels',
            'criteriaScores',
            'dataKepuasan'
        ));
    }

    public function download()
    {
        $surveys = Survey::all();
        $questions = SurveyQuestion::orderBy('order')->get();

        $filename = 'laporan_survey_' . date('Ymd_His') . '.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        // Header CSV
        $columns = ['Email', 'Jenis Kelamin', 'Pendidikan', 'Pekerjaan', 'Tanggal'];

        foreach ($questions as $q) {
            $columns[] = $q->question_text;
        }

        $columns[] = 'Kendala';
        $columns[] = 'Saran';
        $columns[] = 'Waktu Submit';

        $callback = function () use ($surveys, $columns, $questions) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($surveys as $survey) {
                // FIX: Gunakan helper function inline karena $this tidak tersedia di closure
                $jawaban = is_array($survey->jawaban) 
                    ? $survey->jawaban 
                    : (is_string($survey->jawaban) ? json_decode($survey->jawaban, true) : []);

                $row = [
                    $survey->email,
                    $survey->jenis_kelamin,
                    $survey->pendidikan,
                    $survey->pekerjaan,
                    $survey->tanggal,
                ];

                foreach ($questions as $q) {
                    $row[] = $jawaban[$q->id]['jawaban'] ?? '-';
                }

                $row[] = $survey->kendala ?? '-';
                $row[] = $survey->saran ?? '-';
                $row[] = $survey->created_at->format('d/M/Y H:i');

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();
        return back()->with('success', 'Data survey berhasil dihapus.');
    }

    // CRUD Pertanyaan
    public function manageQuestions()
    {
        $questions = SurveyQuestion::orderBy('order')->get();
        return view('SurveyKepuasan.manage-questions', compact('questions'));
    }

    public function storeQuestion(Request $request)
    {
        $validated = $request->validate([
            'question_text' => 'required|string|max:500',
        ]);

        $maxOrder = SurveyQuestion::max('order') ?? 0;

        SurveyQuestion::create([
            'question_text' => $validated['question_text'],
            'order' => $maxOrder + 1,
        ]);

        return back()->with('success', 'Pertanyaan berhasil ditambahkan!');
    }

    public function updateQuestion(Request $request, SurveyQuestion $question)
    {
        $validated = $request->validate([
            'question_text' => 'required|string|max:500',
        ]);

        $question->update($validated);

        return back()->with('success', 'Pertanyaan berhasil diperbarui!');
    }

    public function deleteQuestion(SurveyQuestion $question)
    {
        $question->delete();
        return back()->with('success', 'Pertanyaan berhasil dihapus!');
    }

    /**
     * Helper function untuk decode JSON dengan aman
     * Mengatasi error ketika data sudah berupa array
     */
    private function decodeJsonSafely($data)
    {
        // Jika sudah array, return langsung
        if (is_array($data)) {
            return $data;
        }
        
        // Jika string, decode JSON
        if (is_string($data)) {
            return json_decode($data, true) ?? [];
        }
        
        // Fallback jika tipe data tidak diketahui
        return [];
    }
}