<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ResultController;
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

Route::post('auth/login', [AuthController::class, 'login']);

Route::get('result/current', [ResultController::class, 'current']);
Route::get('result/getcountdown', [ResultController::class, 'getCountdown']);
Route::get('result/listhistory', [ResultController::class, 'listhistory']);
Route::middleware('jwt_token')->group(function () {
    Route::apiResource('result', ResultController::class);
    Route::post('result/count', [ResultController::class, 'count']);
});
