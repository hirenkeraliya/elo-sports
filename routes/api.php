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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/stream/on_publish', [\App\Http\Controllers\LiveStream\LiveStreamController::class, 'onPublish']);


Route::post('/stream/on_stop', [\App\Http\Controllers\LiveStream\LiveStreamController::class, 'onrmptStop']);
//

Route::post('/message', [\App\Http\Controllers\MessageController::class, 'broadcast']);



	/*  stream  api to send new name */
Route::post('/stream-api',[\App\Http\Controllers\LiveStream\LiveStreamController::class, 'renameStreamApi']);    
	

