<?php

use app\Http\Controllers\API\JobController;
use App\Http\Controllers\PingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ping', [PingController::class, 'index']);

Route::group(['prefix' => 'api'], function () {
    Route::group(['prefix' => 'jobs'], function () {
        Route::post('', [JobController::class, 'store']);
        Route::get('/{id}', [JobController::class, 'show']);
        Route::delete('/{id}', [JobController::class, 'destroy']);
    });
});
