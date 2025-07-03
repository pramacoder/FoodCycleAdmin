<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\NotifikasiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', fn() => view('login'))->name('admin.login'); // Ganti dengan view yang sesuai
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// Kategori Routes
Route::get('/kategori', [KategoriController::class, 'index'])->name('categories.index');
Route::post('/kategori', [KategoriController::class, 'store'])->name('categories.store');
Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('categories.update');
Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('categories.destroy');
Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('categories.show');

// Produk Routes
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');
Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');

// Transaksi Routes
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transactions.index');
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transactions.store');
Route::put('/transaksi/{transaksi}', [TransaksiController::class, 'update'])->name('transactions.update');
Route::delete('/transaksi/{transaksi}', [TransaksiController::class, 'destroy'])->name('transactions.destroy');
Route::post('/transaksi/{transaksi}/pajak', [TransaksiController::class, 'addTax'])->name('transactions.addTax');
Route::get('/transaksi/{transaksi}', [TransaksiController::class, 'show'])->name('transactions.show');

// Notifikasi Routes
Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifications.index');
Route::post('/notifikasi', [NotifikasiController::class, 'store'])->name('notifications.store');
Route::get('/notifikasi/{notifikasi}', [NotifikasiController::class, 'show'])->name('notifications.show');

// User Routes
Route::get('/user', [UserController::class, 'index'])->name('users.index');
Route::post('/user', [UserController::class, 'store'])->name('users.store');
Route::put('/user/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/user/{user}', [UserController::class, 'show'])->name('users.show');

// Admin Routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
Route::put('/admin/{admin}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/{admin}', [AdminController::class, 'destroy'])->name('admin.destroy');
Route::get('/admin/{admin}', [AdminController::class, 'show'])->name('admin.show');

// Income Routes
Route::get('/income', [IncomeController::class, 'index'])->name('income.index');
Route::post('/income', [IncomeController::class, 'store'])->name('income.store');
Route::put('/income/{income}', [IncomeController::class, 'update'])->name('income.update');
Route::delete('/income/{income}', [IncomeController::class, 'destroy'])->name('income.destroy');
Route::get('/income/{income}', [IncomeController::class, 'show'])->name('income.show');
