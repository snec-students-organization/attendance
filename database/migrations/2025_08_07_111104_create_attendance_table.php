<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->date('date');                       // attendance date
            $table->unsignedTinyInteger('period');     // periods 1 to 8

            $table->foreignId('student_id')->nullable()->constrained('students')->onDelete('cascade');
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('cascade');

            // Status: present, absent, or free (for free period)
            $table->enum('status', ['present', 'absent', 'free']);

            $table->timestamps();

            // Unique attendance per class, date, period for particular student or teacher
            $table->unique(['class_id', 'date', 'period', 'student_id', 'teacher_id'], 'unique_attendance');
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
