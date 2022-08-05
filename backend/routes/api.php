<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return ['error' => 'Not found'];
});

# Login
Route::post('/login', [LoginController::class, 'login']);
# Register
Route::post('/register', [RegisterController::class, 'register']);

# Get user
Route::get('/user', [UserController::class, 'user']);
# Update user
Route::put('/user', [UserController::class, 'updateUser']);
# Logout user
Route::post('/logout', [UserController::class, 'logout']);

# Get one product
Route::get('/product/{id}', [ProductController::class, 'getProduct']);
# List all products
Route::get('/products', [ProductController::class, 'getProducts']);
# Create new product
Route::post('/products', [ProductController::class, 'createProduct']);
# Update product
Route::put('/product/{id}', [ProductController::class, 'updateProduct']);
# Delete product
Route::delete('/product/{id}', [ProductController::class, 'deleteProduct']);
