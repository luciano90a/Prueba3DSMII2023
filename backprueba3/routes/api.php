<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('getproduct',[ProductController::class, 'index']);
Route::post('gotproduct',[ProductController::class, 'store']);
Route::put('editproduct/{product}', [ProductController::class, 'update']);
Route::delete('deleteproduct/{product}', [ProductController::class, 'destroy']);

