<?php

namespace Routes;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('rooms', [ChatController::class, 'rooms']);
    Route::get('messages/{room_id}', [ChatController::class, 'messages']);
    Route::post('new-message/{room_id}', [ChatController::class, 'newMessage']);
});


Route::post('login', [AuthController::class, 'login']);
Route::post('signup', [AuthController::class, 'signup']);


