<?php

use App\Http\Controllers\ActivityController;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/activities/list', [ActivityController::class, 'list'])->name('activities.list');
Route::get('/activities/complete/{id}', [ActivityController::class, 'completeActivity'])->name('activities.complete');
Route::resource('activities', ActivityController::class);

Route::get('/rewards/list', [RewardController::class, 'list'])->name('rewards.list');
Route::resource('rewards', RewardController::class);
