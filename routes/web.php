<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');


