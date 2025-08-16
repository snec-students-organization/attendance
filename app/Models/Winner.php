<?php

// app/Models/Winner.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $fillable = ['name', 'class', 'items', 'grade'];
}

