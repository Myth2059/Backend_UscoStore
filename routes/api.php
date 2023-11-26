<?php

use App\Http\Controllers\LocalesController;
use App\Http\Controllers\UserController;
use App\Models\Locales;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


    Route::get('/locales', [LocalesController::class, 'index']);
    Route::post('/createuser',[UserController::class,'CreateUser']);
    Route::post('/login',[UserController::class,'Login']);
    Route::post('/createlocal',[LocalesController::class,'CreateLocal']);
    Route::get('/getlocal/{id}',[LocalesController::class,'findLocal']);
