<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\OrderController;
use App\Models\Kategori;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/kategori', [KategoriController::class,'index']);
Route::get('/menu', [MenuController::class,'index']);
Route::get('/order', [OrderController::class,'index']);
Route::post('/kategori', [KategoriController::class,'store']);
Route::post('/menu', [MenuController::class,'store']);
Route::post('/order', [OrderController::class,'store']);
Route::patch('/kategori/{id}', [KategoriController::class,'update']);
Route::patch('/menu/{id}', [MenuController::class,'update']);
Route::patch('/order/{id}', [OrderController::class,'update']);
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);
Route::delete('/menu/{id}', [MenuController::class, 'destroy']);
Route::delete('/order/{id}', [OrderController::class, 'destroy']);
Route::get('/kategori/{id}', [KategoriController::class,'show']);
Route::get('/menu/{id}', [MenuController::class,'show']);
Route::get('/order/{id}', [OrderController::class,'show']);
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);    