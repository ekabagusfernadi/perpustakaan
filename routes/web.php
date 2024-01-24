<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'AdminController@dashboard')->name('home');
Route::get("dashboard", "AdminController@dashboard");
Route::get("katalog", "AdminController@katalog");
Route::get("penerbit", "AdminController@penerbit");
Route::get("pengarang", "AdminController@pengarang");
Route::get("anggota", "AdminController@anggota");
Route::get("buku", "AdminController@buku");
Route::get("peminjaman", "AdminController@peminjaman");
// Route::get("detail_peminjaman", "AdminController@detail_peminjaman");

Route::group(["prefix" => "data"], function() {
    Route::resource("katalog", "KatalogController");
    Route::resource("penerbit", "PenerbitController");
    Route::resource("pengarang", "PengarangController");
    Route::resource("anggota", "AnggotaController");
    Route::resource("buku", "BukuController");
    Route::resource("peminjaman", "PeminjamanController");
    // Route::resource("detail_peminjaman", "DetailPeminjamanController");
});