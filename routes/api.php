<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WooCommerceController;


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

Route::post('/checkout', [CheckoutController::class, 'store']);
Route::get('/woocommerce/checkout', [WooCommerceController::class, 'handleCheckout']);
Route::post('/woocommerce/checkout', [WooCommerceController::class, 'testing']);

Route::post('/test-post', function () {
    return response()->json(['status' => 'POST method works']);
});
