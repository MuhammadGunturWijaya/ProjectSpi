<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Survey;

class LandingPageController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->take(3)->get();

        $surveys = Survey::all(); // ambil semua survey
        $ikm = 0;
        $ikmCategory = '-';

        if ($surveys->count() > 0) {
            // Mapping teks ke skor 1–5
            $scoreMap = [
                'Sangat Puas' => 5,
                'Puas' => 4,
                'Cukup Puas' => 3,
                'Kurang Puas' => 1,
            ];

            $totalScore = 0;
            $totalCount = 0;

            foreach ($surveys as $survey) {
                for ($i = 1; $i <= 9; $i++) {
                    $jawaban = $survey->{'jawaban_'.$i} ?? null;
                    if ($jawaban && isset($scoreMap[$jawaban])) {
                        $totalScore += $scoreMap[$jawaban];
                        $totalCount++;
                    }
                }
            }

            $averageScore = $totalCount > 0 ? $totalScore / $totalCount : 0;
            $ikm = round($averageScore * 20, 1); // skala 0–100

            // Fungsi kategori
            $ikmCategory = $this->getCategoryByScore($ikm);
        }

        return view('LandingPages', compact('beritas', 'ikm', 'ikmCategory'));
    }

    private function getCategoryByScore($score)
    {
        if ($score >= 88.31) return 'Sangat Puas';
        if ($score >= 76.61) return 'Puas';
        if ($score >= 65.00) return 'Cukup Puas';
        if ($score >= 25.00) return 'Kurang Puas';
        return 'Kurang Puas';
    }
}

