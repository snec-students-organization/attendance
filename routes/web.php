<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return redirect()->route('attendance.create');
});

Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
Route::post('/attendance/store-all-periods', [AttendanceController::class, 'storeAllPeriods'])->name('attendance.storeAllPeriods');

Route::get('/attendance/students/{classId}', [AttendanceController::class, 'getStudents'])->name('attendance.students');
Route::get('/attendance/view', [AttendanceController::class, 'index'])->name('attendance.view');
Route::get('/attendance/summary', [AttendanceController::class, 'summaryByDate'])->name('attendance.summary');
Route::get('/attendance/summary/export', [AttendanceController::class, 'exportSummaryPDF'])->name('attendance.summary.export');
Route::get('/attendance/teacher-student-summary', [AttendanceController::class, 'teacherStudentSummary'])
    ->name('attendance.teacherStudentSummary');
