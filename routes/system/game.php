<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\system\GameController;
use App\Http\Middleware\CheckLogin;


Route::prefix('/game')->group(function () {
    Route::get('/', [GameController::class, 'getall'])->name('game-getall')->middleware(CheckLogin::class);
    Route::get('/add', [GameController::class, 'create'])->name('game-create')->middleware(CheckLogin::class);
    Route::post('/add', [GameController::class, 'createHandle'])->name('game-add')->middleware(CheckLogin::class);
    Route::get('/edit/{id}', [GameController::class, 'edit'])->name('game-edit')->middleware(CheckLogin::class);
    Route::post('/edit/{id}', [GameController::class, 'editHandle'])->name('game-update')->middleware(CheckLogin::class);
    Route::delete('/delete/{id}', [GameController::class, 'deleteHandle'])->name('game-delete')->middleware(CheckLogin::class);
    Route::post('/add-coin/{id}', [GameController::class, 'addCoin'])->name('game-add-coin')->middleware(CheckLogin::class);
});
