<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\ClientFloorsController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VacancyController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [NavbarController::class, 'index']);

Route::get('/', [NavbarController::class, 'index']);
// Route::resource('navbar', NavbarController::class)->except(['index']);
Route::group(['prefix' => 'menu', 'as' => 'menu/'], function(){
    Route::post('search', [NavbarController::class, 'search'])->name('search');
});

Route::get('/config', function () {
    return view('config/index');
});

Route::get('/teste', function () {
    return view('vagas/andar-3');
});

Route::group(['prefix' => 'floor', 'as' => 'floor/'], function(){
    Route::get('chouse/{floor}', [ClientFloorsController::class, 'indexFloor'])->name('floor');
    
    Route::post('takeThePosition', [ClientFloorsController::class, 'takeThePosition'])->name('takeThePosition');
});

Route::group(['prefix' => 'config', 'as' => 'config/'], function(){
    Route::get('floor', function () {
        return view('config/floor');
    });

    Route::resource('floor', FloorController::class);

    Route::resource('payment', PaymentController::class);
    
    Route::resource('vacancy', VacancyController::class);
});