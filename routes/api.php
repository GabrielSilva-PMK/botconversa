<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SubscriberController;
use App\Http\Controllers\Api\SubscribersController;
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

// AuthController
Route::get('auth/authenticate', [AuthController::class, 'authenticate']);

// SubscriberController
Route::get('subscriber/index', [SubscriberController::class, 'index']);

// SubscribersController
Route::get('subscribers/index', [SubscribersController::class, 'index']);
