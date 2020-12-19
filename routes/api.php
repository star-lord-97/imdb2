<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TvController;
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

Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::get('/movies', [MovieController::class, 'index']);

Route::get('/tv/{id}', [TvController::class, 'show']);
Route::get('/tv', [TvController::class, 'index']);

Route::get('/actors/page/{page?}', [ActorController::class, 'index']);
Route::get('/actors/{id}', [ActorController::class, 'show']);
