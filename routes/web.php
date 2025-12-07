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
Route::get('/students', StudentsController::class)->name('students');
Route::get('/classes', ClassesController::class)->name('classes');
Route::get('/attendance', AttendanceController::class)->name('attendance');
Route::get('/finance', FinanceController::class)->name('finance');
Route::get('/messages', MessagesController::class)->name('messages');
Route::get('/settings', SettingsController::class)->name('settings');
