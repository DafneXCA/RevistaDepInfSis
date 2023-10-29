<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\revistaController;
use App\Http\Controllers\authController;


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
Route::post('/login',[authController::class,'login']);
Route::get('/Journal',[revistaController::class,'index']);
Route::get('/Journal/download/{id}',[revistaController::class,'download']);
Route::get('/Journal/{id}',[revistaController::class,'show']);


Route::middleware('auth:sanctum')->group(function(){

    Route::post('/Journal',[revistaController::class,'store']);
    Route::patch('/Journal',[revistaController::class,'update']);
    Route::delete('/Journal/{id}',[revistaController::class,'destroy']);
 
    
    
    Route::get('/logout',[authController::class,'logout']);
});


