<?php

use App\Http\Controllers\Api\v1\Admin\Auth\AuthController as AuthAdminController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ColorController;
use App\Http\Controllers\Api\v1\ImageController;
use App\Http\Controllers\Api\v1\ManufactureController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\SizeController;
use App\Http\Controllers\Api\v1\TypeController;
use App\Http\Controllers\Api\v1\User\Auth\AuthController;
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
    // Products Route
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{product}', [ProductController::class, 'show']);
        Route::get('/search/{name}', [ProductController::class, 'search']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/', [ProductController::class, 'store']);
            Route::put('/{product}', [ProductController::class, 'update']);
            Route::delete('/{product}', [ProductController::class, 'destroy']);
        });
    });

    // Manufactures Route
    Route::prefix('manufactures')->group(function () {
        Route::get('/', [ManufactureController::class, 'index']);
        Route::get('/{manufacture}', [ManufactureController::class, 'show']);
        Route::get('/search/{name}', [ManufactureController::class, 'search']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/', [ManufactureController::class, 'store']);
            Route::put('/{manufacture}', [ManufactureController::class, 'update']);
            Route::delete('/{manufacture}', [ManufactureController::class, 'destroy']);
        });
    });

    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('colors', ColorController::class);
    Route::apiResource('types', TypeController::class);
    Route::apiResource('sizes', SizeController::class);
    Route::prefix('images')->group(function () {
        Route::get('/', [ImageController::class, 'index']);
        Route::post('/', [ImageController::class, 'store']);
        Route::delete('/{image}', [ImageController::class, 'destroy']);
        Route::post('/delete-all', [ImageController::class, 'destroyAll']);
        Route::post('/delete-many', [ImageController::class, 'destroyMany']);
    });

    // Auth Controller
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
    });

    // Admin
    Route::prefix('admin')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('login', [AuthAdminController::class, 'login']);
            Route::middleware('auth:sanctum')->post('register', [AuthAdminController::class, 'register']);
        });
    });
});