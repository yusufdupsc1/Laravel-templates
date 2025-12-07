<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/services', [PageController::class, 'services'])->name('services');

Route::get('/posts', [PageController::class, 'posts'])->name('posts');

Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/services', [PageController::class, 'services'])->name('services');

