<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IntervalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RewardController;
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


Route::post('/login', [LoginController::class, 'authenticate']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/intervals', [IntervalController::class, 'index']);
    Route::group(['prefix' => 'activities'], function () {
        Route::get('/complete/{id}', [ActivityController::class, 'complete']);
        Route::get('/', [ActivityController::class, 'index']);
        Route::post('/', [ActivityController::class, 'store']);
        Route::delete('/{id}', [ActivityController::class, 'destroy']);
    });
    Route::group(['prefix' => 'rewards'], function () {
        Route::get('/complete/{id}', [RewardController::class, 'complete']);
        Route::get('/', [RewardController::class, 'index']);
        Route::post('/', [RewardController::class, 'store']);
        Route::delete('/{id}', [RewardController::class, 'destroy']);
    });
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
