<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ResultUploadController;
use App\Http\Controllers\ResultDisplayController;

Route::get('/', function () {
    return view('landing');
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

    // Admin routes
// Admin routes - no auth middleware now
Route::prefix('admin')->group(function() {
    Route::get('/results/upload', [ResultUploadController::class, 'create'])->name('admin.results.create');
    Route::post('/results/upload', [ResultUploadController::class, 'store'])->name('admin.results.store');
});

// Public result search pages
Route::get('/results', [ResultDisplayController::class, 'index'])->name('results.index');
Route::get('/results/search', [ResultDisplayController::class, 'search'])->name('results.search');