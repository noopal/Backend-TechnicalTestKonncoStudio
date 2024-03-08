<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KeranjangController;
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

/*--------------- Barang Controller ---------------*/
Route::controller(BarangController::class)->group(function () {
    Route::get('/barang', 'index');
    Route::post('/barang', 'store');
    Route::get('/barang/show/{id}', 'show');
    Route::put('/barang/update/{id}', 'update');
    Route::delete('/barang/delete/{id}', 'delete');
});
/*--------------- Keranjang Controller ---------------*/
Route::controller(KeranjangController::class)->group(function () {
    Route::get('/keranjang', 'index');
    Route::post('/keranjang', 'store');
    Route::get('/keranjang/show/{id}', 'show');
    Route::put('/keranjang/update/{id}', 'update');
    Route::delete('/keranjang/delete/{id}', 'delete');
});
/*--------------- Checkout Controller ---------------*/
Route::controller(CheckoutController::class)->group(function () {
    Route::get('/checkout', 'index');
    Route::post('/checkout', 'process');
    Route::get('/checkout/show/{id}', 'show');
    Route::put('/checkout/update/{id}', 'success');
});
