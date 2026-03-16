<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\WarehouseController;
use App\Http\Controllers\API\StoreController;
use App\Http\Controllers\API\StockTransferController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Product Management
    Route::post('/products', [ProductController::class, 'create']);
    Route::post('/warehouse', [ProductController::class,'createWarehouse']);
    Route::post('/store', [ProductController::class,'createStore']);

    Route::post('/warehouse/add-stock', [ProductController::class,'addProductsToWarehouse']);

    Route::post('/transfer', [ProductController::class,'addProductsToStore']);


    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);



});