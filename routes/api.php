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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/posts', [\App\Http\Controllers\Api\PostsController::class, 'indax']);
});
// Route::post('/powerlink/create', [\App\Http\Controllers\PowerlinkController::class, 'create']);
// Route::post('/powerlink/uploadFile', [\App\Http\Controllers\PowerlinkController::class, 'uploadFile']);

Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'store']);
