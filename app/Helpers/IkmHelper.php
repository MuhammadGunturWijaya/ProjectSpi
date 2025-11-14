<?php

namespace App\Helpers;

class IkmHelper
{
    /**
     * Hitung IKM dari collection surveys
     * 
     * @param \Illuminate\Support\Collection $surveys
     * @return array ['ikm' => float, 'category' => string, 'averageScore' => float]
     */
    public static function calculateIkm($surveys)
    {
        $scoreMap = [
            'Sangat Puas' => 5,
            'Puas' => 4,
            'Cukup Puas' => 3,
            'Kurang Puas' => 1,
        ];

        $totalScore = 0;
        $totalCount = 0;

        foreach ($surveys as $survey) {
            $answers = json_decode($survey->jawaban ?? '[]', true);

            if (is_array($answers)) {
                foreach ($answers as $answer) {
                    if (isset($answer['jawaban']) && isset($scoreMap[$answer['jawaban']])) {
                        $totalScore += $scoreMap[$answer['jawaban']];
                        $totalCount++;
                    }
                }
            }
        }

        // Rata-rata skor (1-5)
        $averageScore = $totalCount > 0 ? $totalScore / $totalCount : 0;

        // Konversi ke IKM (0-100)
        $ikm = round(($averageScore / 5) * 100, 2);

        // Kategori
        $category = self::getCategoryByScore($ikm);

        return [
            'ikm' => $ikm,
            'category' => $category,
            'averageScore' => round($averageScore, 2),
            'totalAnswers' => $totalCount,
            'totalScore' => $totalScore
        ];
    }

    /**
     * Get category berdasarkan skor IKM
     */
    public static function getCategoryByScore($score)
    {
        if ($score >= 88.31) return 'Sangat Puas';
        if ($score >= 76.61) return 'Puas';
        if ($score >= 65.00) return 'Cukup Puas';
        if ($score >= 25.00) return 'Kurang Puas';
        return 'Kurang Puas';
    }
}