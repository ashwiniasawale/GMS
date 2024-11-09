<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\MotorController;

//Open Routes 
// Route::post("register",[AuthController::class,"register"]);
// Route::post("login",[AuthController::class,"login"]);

// //Protected Routes
// Route::group(["middleware"=>["auth:sanctum"]
// ],function()
// {
//     Route::get("profile",[AuthController::class,"profile"]);
//     Route::get("logout",[AuthController::class,"logout"]);
// });

Route::post('contact',[ContactController::class,"contact"]);
Route::post('career',[ContactController::class,"career"]);
Route::post('motor_control',[MotorController::class,"motor_control"]);