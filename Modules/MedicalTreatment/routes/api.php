<?php

use App\Http\Controllers\Api\V1\MedicalAlterController;
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

Route::get('/medicalalters', [MedicalAlterController::class, 'index']);
Route::get('/medicalalters/{id}', [MedicalAlterController::class, 'show']);
Route::middleware('auth:api')->group(function () {
    Route::post('/medicalalters', [MedicalAlterController::class, 'store']);
    Route::put('/medicalalters/{id}', [MedicalAlterController::class, 'update']);
    Route::delete('/medicalalters/{id}', [MedicalAlterController::class, 'destroy']);
});
