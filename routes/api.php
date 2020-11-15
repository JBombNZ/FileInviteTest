<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\UserController;

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

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('rooms', [RoomController::class, 'index']);
    
    Route::get('user', [UserController::class, 'index']);
    Route::get('logout', [UserController::class, 'logout']);
    
    Route::get('bookings', [BookingController::class, 'index']);
    Route::post('bookings', [BookingController::class, 'store']);
    Route::delete('bookings/{id}', [BookingController::class, 'destroy']);
    
});
