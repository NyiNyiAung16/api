<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PreorderCountController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\LogisticsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PreorderController;
use App\Http\Controllers\ReceipesController;
use App\Http\Controllers\WarehouseController;
use App\Http\Middleware\AuthMiddleware;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// frontend

    // customer
    Route::get('/customers', [CustomerController::class, 'show']);
    Route::post('customer/create', [CustomerController::class, 'createcustomer']);

    //  order
    Route::get('customers/{id}/preorders', [PreorderController::class, 'getPreorders']);
    Route::post('preorders/create', [PreorderController::class, 'createPreorder']);
    Route::get('preorders/{preorder}', [PreorderController::class, 'getPreOrder']);

Route::get('preorders', [OrderController::class, 'getPreordersCountFor12Months']);

// product
Route::get('/products', [ProductController::class, 'all']);
Route::post('/product/create', [ProductController::class, 'create']);

//driver
Route::get('/drivers', [DriverController::class, 'show']);

    //factories
    Route::get('/factories',[FactoryController::class,'show']);
    Route::post('/factories/store',[FactoryController::class,'store']);

    //logistics
    Route::get('/deliver',[LogisticsController::class,'show']);
    Route::post('/deliver',[LogisticsController::class,'make']);
    Route::get('/delivers/count', [LogisticsController::class, 'getCount']);
    Route::get('/delivers/weekly', [LogisticsController::class, 'getCountWeekly']);

    //receipe
    Route::get('/receipes',[ReceipesController::class,'show']);
    Route::post('/receipe/create',[ReceipesController::class,'create']);

    //warehouse
    Route::get('/warehouses',[WarehouseController::class,'show']);
    Route::post('/warehouse/create',[WarehouseController::class,'create']);
    Route::post('order/chart', [PreorderCountController::class, 'preorderCountChart']);

    //sales
    Route::get('/orders',[OrderController::class,'show']);
    Route::post('/order/store',[OrderController::class,'store']);
    Route::post('/order/cancel',[OrderController::class,'cancel']);
