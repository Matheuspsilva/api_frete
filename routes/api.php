<?php

use App\Http\Controllers\Api\Auth\LoginJwtController;
use App\Http\Controllers\Api\FreteController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VeiculoController;
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

Route::post('login', [LoginJwtController::class, 'login'])->name('login');
Route::get('logout', [LoginJwtController::class, 'login'])->name('logout');
Route::get('refresh', [LoginJwtController::class, 'login'])->name('refresh');


Route::group(['middleware' => ['jwt.auth']], function () {

    Route::resource('users', UserController::class);
    Route::resource('veiculos', VeiculoController::class);
    Route::resource('fretes', FreteController::class);

});


