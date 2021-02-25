<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'product'], function () {
    // Usert Profile
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/submit', [ProductController::class, 'store']);
    Route::put('/edit', [ProductController::class, 'update']);
    Route::delete('/{$id}/delete', [ProductController::class, 'delete']);
});
