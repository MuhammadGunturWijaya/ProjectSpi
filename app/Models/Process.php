<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $fillable = [
        'step_number', 'icon', 'title', 'description'
    ];
}
