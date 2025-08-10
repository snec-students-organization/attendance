<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';

    // Added 'pin' here to allow mass assignment when setting class PIN
    protected $fillable = ['name', 'pin'];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}


