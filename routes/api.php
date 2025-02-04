<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    //AUTH
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::group(['middleware' => 'auth:api'], function () {

    //PRODUCT
    Route::get('product', [ProductController::class, 'index']);
    Route::get('product/{id}', [ProductController::class, 'show']);
    Route::post('product', [ProductController::class, 'store']);
    Route::put('product/{id}', [ProductController::class, 'update']);
    Route::delete('product/{id}', [ProductController::class, 'destroy']);
});

Route::group(['middleware' => 'auth:api'], function () {

    //CUSTOMER
    Route::get('customer', [CustomerController::class, 'index']);
    Route::post('customer', [CustomerController::class, 'store']);
    Route::get('customer/{id}', [CustomerController::class, 'show']);
    Route::put('customer/{id}', [CustomerController::class, 'update']);
    Route::delete('customer/{id}', [CustomerController::class, 'destroy']);
});


Route::group(['middleware' => 'auth:api'], function () {

    //SUPPLIER
    Route::get('supplier', [SupplierController::class, 'index']);
    Route::post('supplier', [SupplierController::class, 'store']);
    Route::get('supplier/{id}', [SupplierController::class, 'show']);
    Route::put('supplier/{id}', [SupplierController::class, 'update']);
    Route::delete('supplier/{id}', [SupplierController::class, 'destroy']);
});
