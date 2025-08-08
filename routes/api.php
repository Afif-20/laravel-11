<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware([ 'throttle:5,1'])->group( function(){
    Route::prefix('auth')->group( function(){
        Route::post('login', [UserController::class, 'login']);
        Route::post('regis', [UserController::class, 'store']);
        Route::middleware('auth:sanctum')->group( function(){
            Route::post('logout', [UserController::class, 'logout']);
        });
    });

    Route::middleware(['auth:sanctum'])->group( function(){
        Route::get('user/list-data-paginate', [UserController::class, 'listpaginate']);
        Route::apiResource('users', UserController::class);
    });
});
