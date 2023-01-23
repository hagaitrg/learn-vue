<?php

use App\Http\Controllers\BlogController;
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

Route::prefix('v1')->group(function(){
    Route::prefix('blogs')->group(function(){
        Route::get('/', [BlogController::class, 'index']);
        Route::get('detail', [BlogController::class, 'show']);
        Route::post('/', [BlogController::class, 'store']);
        Route::post('/published', [BlogController::class, 'publish']);
        Route::patch('/update', [BlogController::class, 'update']);
        Route::delete('/delete', [BlogController::class, 'destroy']);
    });
});