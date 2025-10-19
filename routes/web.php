<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');


Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::resource('queues', QueueController::class)->middleware('auth');
Route::resource('staff', StaffController::class)->middleware('auth');
Route::post('call/next', [CallController::class, 'next'])
    ->name('call.next')
    ->middleware('auth');
Route::post('call/done/{id}', [CallController::class, 'done'])
    ->name('call.done')
    ->middleware('auth');
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

