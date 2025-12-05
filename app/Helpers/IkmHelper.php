<?php

namespace App\Helpers;

class IkmHelper
{
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

            // *** Perbaikan disini ***
            $rawAnswers = $survey->jawaban;

            // Jika sudah array → langsung pakai
            if (is_array($rawAnswers)) {
                $answers = $rawAnswers;
            }
            // Jika string JSON → decode
            elseif (is_string($rawAnswers)) {
                $answers = json_decode($rawAnswers, true) ?? [];
            }
            // Selain itu → kosongkan
            else {
                $answers = [];
            }

            // Hitung skor
            foreach ($answers as $answer) {
                if (isset($answer['jawaban']) && isset($scoreMap[$answer['jawaban']])) {
                    $totalScore += $scoreMap[$answer['jawaban']];
                    $totalCount++;
                }
            }
        }

        // Rata-rata skor
        $averageScore = $totalCount > 0 ? $totalScore / $totalCount : 0;

        // Konversi ke IKM (0–100)
        $ikm = round(($averageScore / 5) * 100, 2);

        return [
            'ikm' => $ikm,
            'category' => self::getCategoryByScore($ikm),
            'averageScore' => round($averageScore, 2),
            'totalAnswers' => $totalCount,
            'totalScore' => $totalScore
        ];
    }

    public static function getCategoryByScore($score)
    {
        if ($score >= 88.31) return 'Sangat Puas';
        if ($score >= 76.61) return 'Puas';
        if ($score >= 65.00) return 'Cukup Puas';
        if ($score >= 25.00) return 'Kurang Puas';
        return 'Kurang Puas';
    }
}
