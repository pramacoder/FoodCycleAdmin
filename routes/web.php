<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\NotifikasiController;
use App\Models\kategori;   
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/kategori.index'); // Ganti dengan view yang sesuai
});

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
