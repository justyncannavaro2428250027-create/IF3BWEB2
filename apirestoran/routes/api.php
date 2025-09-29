<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/kategori', [KategoriController::class,'index']);
Route::get('/menu', [MenuController::class,'index']);
Route::get('/order', [OrderController::class,'index']);
Route::post('/kategori', [KategoriController::class,'store']);
Route::post('/menu', [MenuController::class,'store']);
Route::post('/order', [OrderController::class,'store']);
Route::patch('/kategori/{id}', [KategoriController::class,'update']);
Route::patch('/menu/{id}', [MenuController::class,'update']);
Route::patch('/order/{id}', [OrderController::class,'update']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);