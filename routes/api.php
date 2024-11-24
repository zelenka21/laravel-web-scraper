<?php

use app\Http\Controllers\API\JobController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'jobs'], function () {
    Route::post('', [JobController::class, 'store']);
    Route::get('/{id}', [JobController::class, 'show']);
    Route::delete('/{id}', [JobController::class, 'destroy']);
});
