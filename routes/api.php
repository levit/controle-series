<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SeriesController;
use App\Http\Controllers\Api\SeasonsController;

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

Route::controller(SeriesController::class)->group(function() {
    Route::get    ('/series', 'index')->name('index');
    Route::get    ('/series/{id}', 'show')->name('show');
    Route::post   ('/series', 'store')->name('store');
    Route::put    ('/series/{id}', 'update')->name('update');
    Route::delete ('/series/{id}', 'destroy')->name('destroy');

});

Route::controller(SeasonsController::class)->group(function() {
    Route::get    ('/series/{id}/seasons', 'index')->name('index');
});
