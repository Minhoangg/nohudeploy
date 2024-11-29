<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\WellcomeController;
use App\Http\Middleware\CheckLoginClient;

    Route::get('/', [WellcomeController::class, 'index'])->name('wellcome');
    Route::get('/home', [WellcomeController::class, 'home'])->name('home')->middleware(CheckLoginClient::class);
    Route::get('/list-game/{id}', [WellcomeController::class, 'details'])->name('list-game')->middleware(CheckLoginClient::class);
    Route::get('get-score/{id}', [WellcomeController::class, 'getScore'])->name('get-score')->middleware(CheckLoginClient::class);
