<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\BookingController;

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::get('rooms',[RoomController::class,'index']);
Route::get('rooms/{room}',[RoomController::class,'show']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout',[AuthController::class,'logout']);
    Route::get('bookings',[BookingController::class,'index']);
    Route::post('bookings',[BookingController::class,'store']);
    Route::post('bookings/{booking}/cancel', [BookingController::class, 'cancel']);
});
