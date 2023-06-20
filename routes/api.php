<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:admin-api')->group(function(){
    Route::apiResource('categories',CategoryController::class);
    Route::apiResource('products',ProductController::class);
    Route::apiResource("image",ImageController::class);

});

// ممكن استخدام جلب بيانات بواسطة انك تكون مسجل دخول هيك او حسب طريقة فوق تجميع كاملة
// Route::apiResource('products',ProductController::class)->middleware('auth:admin-api');

Route::prefix('auth')->group(function(){
    Route::post('register',[ApiAuthController::class,'register']);
    Route::post('login',[ApiAuthController::class,'login']);

});

Route::prefix('auth')->middleware('auth:admin-api')->group(function(){
Route::get('logout',[ApiAuthController::class,'logout']);
});


