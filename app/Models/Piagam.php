<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piagam extends Model
{
    use HasFactory;
    protected $table = 'piagams';
    protected $fillable = ['nama_piagam', 'tahun', 'file_path'];
}
