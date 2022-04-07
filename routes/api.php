<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;

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
Broadcast::routes(['middleware' => ['auth:sanctum']]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'user_confirmation'])->prefix('v1')->group(function () {
    Route::post('/posts', [\App\Http\Controllers\Api\PostsController::class, 'index']);
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);
});

// Route::post('/powerlink/create', [\App\Http\Controllers\PowerlinkController::class, 'create']);
// Route::post('/powerlink/uploadFile', [\App\Http\Controllers\PowerlinkController::class, 'uploadFile']);

Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'store']);
