<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product-management', function () {
    return view('product-management');
});

Route::post('/product', [ProductController::class,'createProduct']);
Route::post('/warehouse', [ProductController::class,'createWarehouse']);
Route::post('/store', [ProductController::class,'createStore']);
Route::post('/warehouse/add-stock', [ProductController::class,'addStockToWarehouse']);
Route::post('/transfer', [ProductController::class,'transferToStore']);