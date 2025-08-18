<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'item_name',
        'student_name',
        'class',
        'position',
        'grade',
    ];
}

