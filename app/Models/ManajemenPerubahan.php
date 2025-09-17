<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemenPerubahan extends Model
{
    use HasFactory;
    protected $table = 'manajemenperubahan'; // ini boleh tetap
    protected $fillable = ['nama_manajemen', 'tahun', 'file_path'];
}
