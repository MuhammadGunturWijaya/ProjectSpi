<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\SurveyQuestion;

class SurveyController extends Controller
{
    public function index()
    {
        return view('SurveyKepuasan.Survey-Kepuasan');
    }

    public function store(Request $request)
    {
        $allQuestions = SurveyQuestion::orderBy('order')->get();
        $defaultQuestions = $allQuestions->take(9);
        $customQuestions = $allQuestions->skip(9);

        $rules = [];
        for ($i = 0; $i < $defaultQuestions->count(); $i++) {
            $rules["jawaban.$i"] = 'required|string';
        }

        foreach ($customQuestions as $question) {
            $rules["jawaban_custom.{$question->id}"] = 'required|string';
        }

        $rules['kendala'] = 'nullable|string';
        $rules['saran'] = 'nullable|string';
        $rules['tanggal'] = 'required|date';
        $rules['jenis_kelamin'] = 'required|string';
        $rules['pendidikan'] = 'required|string';
        $rules['pekerjaan'] = 'required|string';

        $validated = $request->validate($rules);

        $answers = [];

        foreach ($defaultQuestions as $index => $question) {
            $answers[$question->id] = [
                'pertanyaan' => $question->question_text,
                'jawaban' => $validated['jawaban'][$index] ?? '-'
            ];
        }

        foreach ($customQuestions as $question) {
            $answers[$question->id] = [
                'pertanyaan' => $question->question_text,
                'jawaban' => $request->input("jawaban_custom.{$question->id}") ?? '-'
            ];
        }

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
    }

    public function showAll()
    {
        // Ambil semua survey dan pertanyaan
        $surveys = Survey::latest()->get();
        $questions = SurveyQuestion::orderBy('order')->get();

        // Buat label otomatis Q1, Q2, dst sesuai jumlah pertanyaan
        $questionLabels = [];
        for ($i = 1; $i <= $questions->count(); $i++) {
            $questionLabels[] = "Q{$i}";
        }

        // Hitung rata-rata skor setiap pertanyaan
        $criteriaScores = [];

        foreach ($questions as $question) {
            $surveysData = Survey::all();
            $totalScore = 0;
            $count = 0;

            foreach ($surveysData as $survey) {
                $jawaban = $survey->jawaban;
                if (is_string($jawaban)) {
                    $jawaban = json_decode($jawaban, true) ?? [];
                }

                if (!empty($jawaban[$question->id]['jawaban'])) {
                    $value = match ($jawaban[$question->id]['jawaban']) {
                        'Sangat Puas' => 5,
                        'Puas' => 4,
                        'Cukup Puas' => 3,
                        'Kurang Puas' => 2,
                        default => 0,
                    };
                    $totalScore += $value;
                    $count++;
                }
            }

            $criteriaScores[] = $count > 0 ? round($totalScore / $count, 2) : 0;
        }

        // Kirim semua data ke view
        return view('SurveyKepuasan.lihat-survey', compact(
            'surveys',
            'questions',
            'questionLabels',
            'criteriaScores'
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
                $jawaban = $survey->jawaban;
                if (is_string($jawaban)) {
                    $jawaban = json_decode($jawaban, true) ?? [];
                }


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

}
