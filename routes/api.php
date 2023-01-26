<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-province', App\Http\Controllers\Api\GetProvinceController::class);
Route::get('/get-regency', App\Http\Controllers\Api\GetRegencyController::class);
Route::get('/get-district', App\Http\Controllers\Api\GetDistrictController::class);
Route::get('/get-village', App\Http\Controllers\Api\GetVillageController::class);
Route::resource('/neighbourhood', App\Http\Controllers\Api\NeighbourhoodController::class)
    ->except(['create', 'show', 'edit']);
Route::resource('/pengurus-partai', App\Http\Controllers\Api\PengurusPartaiController::class)
    ->only(['index']);
