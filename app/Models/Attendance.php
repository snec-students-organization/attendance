<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;  // Add this import

class Attendance extends Model
{
    protected $fillable = [
        'class_id',
        'date',
        'period',
        'student_id',
        'teacher_id',
        'subject_id',    // Add this if you want mass assignment on subject_id
        'status',
        'reason'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
