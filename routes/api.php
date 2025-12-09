<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/students', fn () => \App\Models\Student::paginate(20));
    Route::get('/classes', fn () => \App\Models\ClassSession::paginate(20));
    Route::get('/invoices', fn () => \App\Models\Invoice::paginate(20));
    Route::get('/messages', fn () => \App\Models\Message::paginate(20));
    Route::get('/attendance', fn () => \App\Models\AttendanceSummary::all());
});
