<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public Route
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/user/register', [AuthController::class, 'user_register']);
Route::post('/user/login', [AuthController::class, 'user_login']);

Route::get('/produks', [ProdukController::class, 'index']);
Route::get('/Produks/{id}', [ProdukController::class, 'show']);

//Protected Route
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('produks', ProdukController::class)->except('create', 'edit');
    Route::resource('checkouts', CheckoutController::class)->except('create', 'edit');
    Route::resource('payments', PaymentController::class)->except('create', 'edit');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/user/logout', [AuthController::class, 'user_logout']);
    Route::resource('admins', AdminController::class)->except('create', 'edit');
});

// Route::resource('produks', ProdukController::class)->except(
//     ['create', 'edit']
// );