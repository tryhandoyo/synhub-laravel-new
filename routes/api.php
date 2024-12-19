<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BayarController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\customer\PesananController;
use App\Http\Controllers\ProdukController;

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

// Admin
Route::resource('/users', UserController::class);
Route::resource('/banner', BannerController::class);
// Route::resource('/produk', ProdukController::class);
Route::post('/produk', [ProdukController::class, 'store']);
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/all', [ProdukController::class, 'showAll']);
Route::get('/produk/{produk}', [ProdukController::class, 'show']);
Route::post('/produk/{produk}', [ProdukController::class, 'update']);
Route::delete('/produk/{produk}', [ProdukController::class, 'destroy']);
Route::resource('/bayar', BayarController::class);
Route::post('/bayar', [BayarController::class, 'store']);
Route::get('/bayar', [BayarController::class, 'index']);
Route::get('/bayar/{bayar}', [BayarController::class, 'show']);
Route::put('/bayar/{bayar}', [BayarController::class, 'update']);
Route::delete('/bayar/{bayar}', [BayarController::class, 'destroy']);
Route::get('/pesanan', [AdminController::class, 'index']);
Route::get('/pesanan/{pesanan}', [AdminController::class, 'show']);
Route::post('/ubah-status-pesanan', [AdminController::class, 'update']);


// Customer
Route::post('/customer/pesanan', [PesananController::class, 'store']);
Route::post('/upload-bukti-bayar', [PesananController::class, 'update']);
Route::get('/customer/banner', [CustomerController::class, 'indexBanner']);
Route::get('/customer/produk', [CustomerController::class, 'indexProduk']);
Route::get('/customer/produk/{produk}', [CustomerController::class, 'indexProdukShow']);
Route::get('/customer/bayar', [CustomerController::class, 'indexBayar']);


