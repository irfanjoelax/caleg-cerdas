<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Auth::routes([
    'register' => false,
    'reset'    => false
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('home');

    Route::resource('/profile', App\Http\Controllers\ProfileController::class)
        ->only(['index', 'store']);

    Route::resource('/province', App\Http\Controllers\ProvinceController::class)
        ->only('index');

    Route::resource('/regency', App\Http\Controllers\RegencyController::class)
        ->only('index', 'show');

    Route::resource('/district', App\Http\Controllers\DistrictController::class)
        ->only('index', 'edit', 'update', 'show');

    Route::resource('/village', App\Http\Controllers\VillageController::class)
        ->only('index', 'show');

    Route::resource('/neighbourhood', App\Http\Controllers\NeighbourhoodController::class)
        ->except('show');

    Route::resource('/pengurus-partai', App\Http\Controllers\PengurusPartaiController::class)
        ->except('show');

    Route::resource('/caleg', App\Http\Controllers\CalegController::class)
        ->except('show');

    Route::resource('/neighbourhood', App\Http\Controllers\NeighbourhoodController::class)
        ->except('show');

    Route::resource('/voting-place', App\Http\Controllers\VotingPlaceController::class)
        ->except('show');

    Route::resource('/relawan', App\Http\Controllers\RelawanController::class)
        ->except('show');

    Route::resource('/pendukung', App\Http\Controllers\PendukungController::class);

    Route::resource('/user', App\Http\Controllers\UserController::class)
        ->except('show');
});
