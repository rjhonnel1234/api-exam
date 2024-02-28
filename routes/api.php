<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('register', [AuthController::class, 'register'])->middleware('restrictRole:admin');
    Route::get('/users', [UserController::class, 'index'])->middleware('restrictRole:admin');
    Route::get('/users/{user}', [UserController::class, 'show'])->middleware('restrictRole:admin');
    Route::put('/users/{user}', [UserController::class, 'update'])->middleware('restrictRole:admin');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('restrictRole:admin');
});
