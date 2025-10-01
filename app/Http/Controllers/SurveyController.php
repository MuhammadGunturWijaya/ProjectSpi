<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Survey;

class SurveyController extends Controller
{

    public function index()
    {
        $jumlahPertanyaan = 9; // ubah sesuai jumlah soal yang sebenarnya
        return view('SurveyKepuasan.Survey-Kepuasan', compact('jumlahPertanyaan'));
    }


    public function store(Request $request)
    {
        // Validasi semua jawaban pertanyaan
        $rules = [];
        for ($i = 0; $i < 9; $i++) {
            $rules["jawaban.$i"] = 'required|string';
        }

        $rules['kendala'] = 'nullable|string';
        $rules['saran'] = 'nullable|string';
        $rules['tanggal'] = 'required|date'; // ✅ Validasi tanggal
        $rules['jenis_kelamin'] = 'required|string';
        $rules['pendidikan'] = 'required|string';
        $rules['pekerjaan'] = 'required|string';


        $validated = $request->validate($rules);

        // Simpan survey ke database
        Survey::create([
            'email' => Auth::user()->email,
            'tanggal' => $validated['tanggal'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'pendidikan' => $validated['pendidikan'],
            'pekerjaan' => $validated['pekerjaan'],
            'jawaban_1' => $validated['jawaban'][0],
            'jawaban_2' => $validated['jawaban'][1],
            'jawaban_3' => $validated['jawaban'][2],
            'jawaban_4' => $validated['jawaban'][3],
            'jawaban_5' => $validated['jawaban'][4],
            'jawaban_6' => $validated['jawaban'][5],
            'jawaban_7' => $validated['jawaban'][6],
            'jawaban_8' => $validated['jawaban'][7],
            'jawaban_9' => $validated['jawaban'][8],
            'kendala' => $validated['kendala'] ?? null,
            'saran' => $validated['saran'] ?? null,
        ]);


        return back()->with('survey_success', 'Terima kasih telah mengisi survey!');
    }


    public function showAll()
    {
        $surveys = Survey::latest()->get();
        return view('SurveyKepuasan.lihat-survey', compact('surveys'));
    }

    public function download()
    {
        $surveys = Survey::all(); // ambil semua data survei

        $filename = 'laporan_survey_' . date('Ymd_His') . '.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['Email', 'Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q7', 'Q8', 'Q9', 'Kendala', 'Saran', 'Waktu'];

        $callback = function () use ($surveys, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($surveys as $survey) {
                $row = [
                    $survey->email,
                    $survey->jawaban_1,
                    $survey->jawaban_2,
                    $survey->jawaban_3,
                    $survey->jawaban_4,
                    $survey->jawaban_5,
                    $survey->jawaban_6,
                    $survey->jawaban_7,
                    $survey->jawaban_8,
                    $survey->jawaban_9,
                    $survey->kendala ?? '-',
                    $survey->saran ?? '-',
                    $survey->created_at->format('d/M H:i')
                ];
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



}
