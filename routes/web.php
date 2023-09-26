<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Autenticador;
use App\Mail\SeriesCreated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/ola', function() {
    echo 'Ola Mundo!';
});

*/


Route::get('/', function () {
    return redirect('/series');
})->middleware(Autenticador::class);

Route::get('/email', function() {
    return new SeriesCreated(1, 'The Walking Death', 15, 20);
});

/*
Route::get('series', [SeriesController::class, 'index']);
Route::get('series/criar', [SeriesController::class, 'create']);
Route::post('series/salvar', [SeriesController::class, 'store']);
*/

Route::controller(LoginController::class)->group(function() {
    Route::get    ('/login', 'index')->name('login');
    Route::post   ('/login', 'store')->name('login.sign');
    Route::get    ('/logout', 'destroy')->name('login.logout');
});

Route::middleware('autenticador')->group(function() {

    Route::controller(SeriesController::class)->group(function(){
        Route::get   ('/series', 'index')->name('series.index')->withoutMiddleware('autenticador');
        Route::get   ('/series/criar', 'create')->name('series.create');
        Route::post  ('/series/salvar', 'store')->name('series.store');
        Route::delete('/series/excluir/{series}', 'destroy')->name('series.destroy')->whereNumber('series');
        Route::get   ('/series/{series}/edit', 'edit')->name('series.edit');
        Route::put   ('/series/update/{series}', 'update')->name('series.update');
    });

    Route::controller(SeasonsController::class)->group(function(){
        Route::get   ('/series/{series}/seasons', 'index')->name('seasons.index');
    });

    Route::controller(EpisodesController::class)->group(function(){
        Route::get   ('/seasons/{season}/episodes', 'index') ->name('episodes.index');
        Route::post  ('/seasons/{season}/episodes', 'update')->name('episodes.update');
        //Route::put('seasons/{season}/episodes', 'update')->name('episodes.update');
    });

    Route::controller(UserController::class)->group(function() {
        Route::get   ('/registrer', 'create')->name('users.create');
        Route::post  ('/registrer', 'store')->name('users.store');
    });

});
