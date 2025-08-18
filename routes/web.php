<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ResultController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Results viewing route accessible to authenticated users
    Route::get('/results', [ResultController::class, 'index'])->name('results.index');

    // Attendance routes - consider protecting these with middleware if needed
    Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::post('/attendance/store-all-periods', [AttendanceController::class, 'storeAllPeriods'])->name('attendance.storeAllPeriods');
    Route::get('/attendance/students/{classId}', [AttendanceController::class, 'getStudents'])->name('attendance.students');
    Route::get('/attendance/view', [AttendanceController::class, 'index'])->name('attendance.view');
    Route::get('/attendance/summary', [AttendanceController::class, 'summaryByDate'])->name('attendance.summary');
    Route::get('/attendance/summary/export', [AttendanceController::class, 'exportSummaryPDF'])->name('attendance.summary.export');
    Route::get('/attendance/teacher-student-summary', [AttendanceController::class, 'teacherStudentSummary'])
        ->name('attendance.teacherStudentSummary');
});

// Routes only accessible by authenticated admins
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/results/create', [ResultController::class, 'create'])->name('results.create');
    Route::post('/results', [ResultController::class, 'store'])->name('results.store');
});

require __DIR__.'/auth.php';

