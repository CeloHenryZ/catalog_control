<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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

Route::prefix('/auth')->group(function() {
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('/category')->group(function() {
    Route::post("/store", [CategoryController::class, 'store']);
    Route::get("/list", [CategoryController::class, 'list']);
    Route::put("/update/{id}", [CategoryController::class, 'update']);
    Route::delete("/delete/{id}", [CategoryController::class, 'delete']);
});

Route::prefix('/product')->group(function() {
    Route::post("/store", [ProductController::class, 'store']);
    Route::get("/list", [ProductController::class, 'list']);
    Route::put("/update/{id}", [ProductController::class, 'update']);
    Route::delete("/delete/{id}", [ProductController::class, 'delete']);
});
