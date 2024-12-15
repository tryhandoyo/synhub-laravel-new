<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BayarController;
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

Route::resource('/users', UserController::class);
Route::resource('/banner', BannerController::class);
Route::resource('/produk', ProdukController::class);
Route::resource('/bayar', BayarController::class);
Route::post('/pesanan', [PesananController::class, 'store']);