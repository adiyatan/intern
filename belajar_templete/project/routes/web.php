<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-package',function(){
    // test penjumalah
    $data_array_yg_ingin_dijumlah = [3,4,1];
    $hasil = \adiya\kalkulator\SimpleKalkulator::penjumlahan($data_array_yg_ingin_dijumlah);
    echo "hasilnya adalah ".$hasil;
});