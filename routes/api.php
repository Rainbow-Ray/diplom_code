<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecksApiController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialTypeController;

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

Route::get('/checks', [ChecksApiController::class, 'index']);
Route::get('/checks', [ChecksApiController::class, 'index']);

Route::get("types/{id}", [MaterialTypeController::class, 'apiIndex']);
Route::get("types", [MaterialTypeController::class, 'apiAll']);

Route::get("materials", [MaterialController::class, 'apiIndex']);
Route::get("equips", [EquipController::class, 'apiIndex']);
