<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Middleware\DebugHeadersMiddleware;

Route::middleware([DebugHeadersMiddleware::class])->group(function () {
    Route::prefix('guests')->group(function () {
        Route::post('/', [GuestController::class, 'create']);
        Route::get('/', [GuestController::class, 'index']);
        Route::get('{id}', [GuestController::class, 'show']);
        Route::put('{id}', [GuestController::class, 'update']);
        Route::delete('{id}', [GuestController::class, 'destroy']);
    });
});
