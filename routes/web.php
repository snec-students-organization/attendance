<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\WinnerController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

Route::get('/', function () {
    return view('landing');
});

// Attendance routes
Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
Route::post('/attendance/store-all-periods', [AttendanceController::class, 'storeAllPeriods'])->name('attendance.storeAllPeriods');

Route::get('/attendance/students/{classId}', [AttendanceController::class, 'getStudents'])->name('attendance.students');
Route::get('/attendance/view', [AttendanceController::class, 'index'])->name('attendance.view');
Route::get('/attendance/summary', [AttendanceController::class, 'summaryByDate'])->name('attendance.summary');
Route::get('/attendance/summary/export', [AttendanceController::class, 'exportSummaryPDF'])->name('attendance.summary.export');
Route::get('/attendance/teacher-student-summary', [AttendanceController::class, 'teacherStudentSummary'])
    ->name('attendance.teacherStudentSummary');

// Public fest results page
Route::get('/fest-results', [WinnerController::class, 'index'])->name('winners.index');

// Admin routes - protected by auth and admin middleware

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/winners/create', [WinnerController::class, 'create'])->name('winners.create');
    Route::post('/admin/winners', [WinnerController::class, 'store'])->name('winners.store');
});

// Authentication routes provided by Laravel
Auth::routes();

// Home route - typically after login
Route::get('/home', [HomeController::class, 'index'])->name('home');


