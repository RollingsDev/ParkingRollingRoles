<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\FloorsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VacancyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/config', function () {
    return view('config/index');
});

Route::get('/teste', function () {
    return view('vagas/andar-3');
});

Route::group(['prefix' => 'floor', 'as' => 'floor/'], function(){
    Route::get('chouse/{floor}', [FloorsController::class, 'indexFloorOne'])->name('floor');
});

Route::group(['prefix' => 'config', 'as' => 'config/'], function(){
    Route::get('floor', function () {
        return view('config/floor');
    });

    Route::resource('floor', FloorController::class);

    Route::resource('payment', PaymentController::class);
    
    Route::resource('vacancy', VacancyController::class);
});