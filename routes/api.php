<?php

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

Route::get('/posts', [\App\Http\Controllers\ClientController::class , 'getAllPost']);

Route::post('/powerlink/create', [\App\Http\Controllers\PowerlinkController::class, 'create']);
Route::post('/powerlink/uploadFile', [\App\Http\Controllers\PowerlinkController::class, 'uploadFile']);
