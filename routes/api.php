<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\ServiceController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('queues', QueueController::class)->middleware('auth');
Route::resource('staff', StaffController::class);
Route::resource('services', ServiceController::class)->middleware('auth');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';