<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RewardController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/activities/list', [ActivityController::class, 'list'])->name('activities.list');
Route::post('/activities/complete', [ActivityController::class, 'completeActivity'])->name('activities.complete');
Route::resource('activities', ActivityController::class);

Route::get('/rewards/list', [RewardController::class, 'list'])->name('rewards.list');
Route::post('/rewards/complete', [RewardController::class, 'completeReward'])->name('rewards.complete');
Route::resource('rewards', RewardController::class);
