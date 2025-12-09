<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\SettingsController;

Route::get('/', DashboardController::class)->name('dashboard');
Route::get('/dashboard', DashboardController::class);
Route::resource('students', StudentsController::class)->only(['index', 'store', 'update', 'destroy']);
Route::get('/students/export', [StudentsController::class, 'export'])->name('students.export');
Route::resource('classes', ClassesController::class)->only(['index', 'store', 'update', 'destroy']);
Route::get('/attendance', AttendanceController::class)->name('attendance');
Route::post('/attendance', [AttendanceController::class, 'update'])->name('attendance.update');
Route::resource('finance', FinanceController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('messages', MessagesController::class)->only(['index', 'store', 'destroy']);
Route::get('/settings', SettingsController::class)->name('settings');
Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
