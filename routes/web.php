<?php

use App\Http\Controllers\FloorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/config', function () {
    return view('config/index');
});

Route::get('/teste', function () {
    return view('vagas/andar-3');
});

Route::group(['prefix' => 'config', 'as' => 'config/'], function(){
    Route::get('floor', function () {
        return view('config/floor');
    });

    Route::resource('floor', FloorController::class);
});