<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/services/{slug}', [HomeController::class, 'service'])->name('service');
Route::get('/reviews', [HomeController::class, 'reviews'])->name('reviews');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/{slug}', [HomeController::class, 'page'])->name('page');
