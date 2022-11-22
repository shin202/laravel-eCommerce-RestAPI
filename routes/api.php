<?php

use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ImageController;
use App\Http\Controllers\Api\v1\ManufactureController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\SizeController;
use App\Http\Controllers\Api\v1\TypeController;
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
Route::prefix('v1')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::apiResource('manufactures', ManufactureController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('types', TypeController::class);
    Route::apiResource('sizes', SizeController::class);
    Route::prefix('images')->group(function () {
        Route::get('/', [ImageController::class, 'index']);
        Route::post('/', [ImageController::class, 'store']);
        Route::delete('/{image}', [ImageController::class, 'destroy']);
        Route::post('/delete-all', [ImageController::class, 'destroyAll']);
        Route::post('/delete-many', [ImageController::class, 'destroyMany']);
    });
});