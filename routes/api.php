<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'paypal'], function () {

    Route::post('/order/create', [App\Http\Controllers\CheckoutController::class, 'create'])->name('paypal.create');

    Route::post('/order/capture/', [App\Http\Controllers\CheckoutController::class, 'capture'])->name('paypal.capture');
});
