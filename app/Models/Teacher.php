<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name', 'subject_id']; // Include subject_id if you want mass assignment

    /**
     * Get the subject that the teacher belongs to.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}

