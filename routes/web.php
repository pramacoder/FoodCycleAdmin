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
    return view('welcome');
});

Route::resource('kategori', KategoriController::class);
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::resource('admin/products', ProdukController::class);
Route::resource('admin/transactions', TransaksiController::class);
Route::resource('admin/notifications', NotifikasiController::class);
Route::resource('admin/users', UserController::class);
Route::get('admin/income', [IncomeController::class, 'index'])->name('admin.income');
