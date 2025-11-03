<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_text',
        'order',
    ];

    protected static function booted()
    {
        static::deleting(function ($question) {
            $surveys = \App\Models\Survey::all();

            foreach ($surveys as $survey) {
                // Pastikan jawaban berupa array
                $answers = $survey->jawaban;

                if (is_string($answers)) {
                    $answers = json_decode($answers, true) ?? [];
                }

                // Jika jawaban mengandung ID pertanyaan yang dihapus
                if (isset($answers[$question->id])) {
                    unset($answers[$question->id]); // hapus dari JSON

                    // Simpan kembali JSON yang sudah diperbarui
                    $survey->jawaban = json_encode($answers, JSON_UNESCAPED_UNICODE);
                    $survey->save();
                }
            }
        });
    }

}
