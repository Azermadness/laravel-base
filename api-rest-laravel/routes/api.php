<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BirdController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AuthController;

Route::get('/products', [ProductController::class, 'index']);

Route::post('/product-add', [ProductController::class, 'create']);

Route::post('/product-update', [ProductController::class, 'update']);

Route::delete('/product-delete', [ProductController::class, 'delete']);

Route::get('/birds', [BirdController::class, 'index']);
Route::get('/birds/minsize', [BirdController::class, 'minsize']);
Route::get('/birds/minsizeforest', [BirdController::class, 'minsizeforest']);
Route::get('/birds/firstletterm', [BirdController::class, 'firstletterM']);
Route::get('/birds/firstlettermcomplex', [BirdController::class, 'firstletterMcomplex']);
Route::get('/birds/jardins', [BirdController::class, 'jardins']);
Route::get('/birds/poids', [BirdController::class, 'poids']);
Route::get('/birds/chiante', [BirdController::class, 'chiante']);
Route::get('/birds/sortalphabet', [BirdController::class, 'sortalphabet']);

Route::apiResource('homes', HomeController::class);
Route::apiResource('owners', OwnerController::class);

Route::get('/owners/{id}/homes', [OwnerController::class, 'owner_home']);

// auth

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('me', [AuthController::class, 'me']);

Route::middleware('auth:sanctum')->get('owners/{id}/homes', [HomeController::class, 'owner_home']);