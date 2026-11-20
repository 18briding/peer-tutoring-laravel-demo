<?php

use App\Http\Controllers\TutoringRequestController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/requests');

Route::get(
    '/requests',
    [TutoringRequestController::class, 'index']
)->name('requests.index');

Route::get(
    '/requests/create',
    [TutoringRequestController::class, 'create']
)->name('requests.create');

Route::post(
    '/requests',
    [TutoringRequestController::class, 'store']
)->name('requests.store');

Route::get(
    '/requests/{tutoringRequest}',
    [TutoringRequestController::class, 'show']
)->whereNumber('tutoringRequest')->name('requests.show');