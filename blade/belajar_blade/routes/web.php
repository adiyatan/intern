<?php

use App\Http\Controllers\BlogController;
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

//blog
Route::get('/blog', [BlogController::class,'home'])->name('home');
Route::get('/blog/tentang', [BlogController::class,'tentang'])->name('tentang');
Route::get('/blog/kontak', [BlogController::class,'kontak'])->name('kontak');

