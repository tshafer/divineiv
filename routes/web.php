<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/services/{slug}', [HomeController::class, 'service'])->name('service');
Route::get('/reviews', [HomeController::class, 'reviews'])->name('reviews');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');

// Contact form routes
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
Route::post('/contact-us', [ContactController::class, 'send'])->name('contact.send');

Route::get('/{slug}', [HomeController::class, 'page'])->name('page');
