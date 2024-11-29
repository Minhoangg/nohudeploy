<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\system\LobbyController;

Route::prefix('/lobby')->group(function () {
    Route::get('', [LobbyController::class, 'index'])->name('lobby-list');
    Route::get('/create', [LobbyController::class, 'create'])->name('lobby-create');
    Route::post('/create', [LobbyController::class, 'store'])->name('lobby-store');
    Route::get('/edit/{id}', [LobbyController::class, 'edit'])->name('lobby-edit');
    Route::post('/edit/{id}', [LobbyController::class, 'update'])->name('lobby-update');
    Route::delete('/delete/{id}', [LobbyController::class, 'delete'])->name('lobby-delete');
});
