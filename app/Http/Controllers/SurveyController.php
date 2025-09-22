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

        $request->validate($rules);

        // Simpan survey ke database
        Survey::create([
            'email' => Auth::user()->email,  // wajib ada
            'jawaban_1' => $request->jawaban[0],
            'jawaban_2' => $request->jawaban[1],
            'jawaban_3' => $request->jawaban[2],
            'jawaban_4' => $request->jawaban[3],
            'jawaban_5' => $request->jawaban[4],
            'jawaban_6' => $request->jawaban[5],
            'jawaban_7' => $request->jawaban[6],
            'jawaban_8' => $request->jawaban[7],
            'jawaban_9' => $request->jawaban[8],
            'kendala' => $request->kendala,
            'saran' => $request->saran,
        ]);

        return back()->with('survey_success', 'Terima kasih telah mengisi survey!');
    }
}
