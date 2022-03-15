<?php

use App\Http\Controllers\CommissionerController;
use App\Http\Controllers\PropertiesController;
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


Route::get('/property', [PropertiesController::class, 'index']);
Route::post('/login', [CommissionerController::class, 'login']);
Route::get('/property/{id}',[PropertiesController::class, 'show']);
Route::post('/property',[PropertiesController::class, 'store']);  //->middleware("auth:sanctum");
Route::post('/register', [CommissionerController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('/property/{id}', [PropertiesController::class, 'update']);
Route::delete('/property/{id}',[PropertiesController::class, 'destroy']);