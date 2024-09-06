<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BirdController;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);

Route::post('/product-add', [ProductController::class, 'create']);

Route::get('/birds', [BirdController::class, 'index']);
Route::get('/birds/minsize', [BirdController::class, 'minsize']);
Route::get('/birds/minsizeforest', [BirdController::class, 'minsizeforest']);
Route::get('/birds/firstletterm', [BirdController::class, 'firstletterM']);
Route::get('/birds/firstlettermcomplex', [BirdController::class, 'firstletterMcomplex']);
Route::get('/birds/jardins', [BirdController::class, 'jardins']);
Route::get('/birds/poids', [BirdController::class, 'poids']);
Route::get('/birds/chiante', [BirdController::class, 'chiante']);
Route::get('/birds/sortalphabet', [BirdController::class, 'sortalphabet']);
