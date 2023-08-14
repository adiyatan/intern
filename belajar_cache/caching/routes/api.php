<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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

Route::get('/orders', function () {
    // cara ke1
    $keyCache = 'order_summary';
    // $orders = Cache::get($keyCache);
    // if ($orders) {
    //     return $orders;
    // }

    // $orders = DB::table('products')->select([
    //     'product_code',
    //     DB::raw('sum(qty) as total_qty'),
    //     DB::raw('sum(price) as total_price')
    // ])
    //     ->groupBy('product_code')
    //     ->get();

    // Cache::put($keyCache, $orders, now()->addMinutes(6)); // Changed 6 to now()->addMinutes(6)

    // cara ke2
    $orders = Cache::remember($keyCache, 60, function () {
        DB::table('products')->select([
            'product_code',
            DB::raw('sum(qty) as total_qty'),
            DB::raw('sum(price) as total_price')
        ])
            ->groupBy('product_code')
            ->get();
    });
    return $orders;
});