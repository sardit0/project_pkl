<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbusController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\KaluarController;
use App\Http\Controllers\MinjemController;
use App\Http\Controllers\KembaliController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.backend');
})-> middleware('auth');

Route::group(['prefix' => 'dashboard','middleware'], function () {
    Route::resource('abus', AbusController::class);
    Route::resource('data', DataController::class);
    Route::resource('kaluar', KaluarController::class);
    Route::resource('peminjaman', MinjemController::class);
    Route::resource('kembalian', KembaliController::class);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



