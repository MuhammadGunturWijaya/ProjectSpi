<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Survey;

class SurveyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kepuasan' => 'required|string',
            'saran' => 'nullable|string',
        ]);

        Survey::create([
            'email' => Auth::user()->email, // <--- WAJIB ADA
            'kepuasan' => $request->kepuasan,
            'saran' => $request->saran,
        ]);

        return back()->with('survey_success', 'Terima kasih telah mengisi survey!');
    }
}