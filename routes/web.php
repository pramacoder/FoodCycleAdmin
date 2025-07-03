<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\IncomeController; // Perbaikan: hapus namespace duplikat

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Guest routes (redirect to login if authenticated)
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Admin routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        
        // Dashboard - Perbaikan: hilangkan duplikat dan typo
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.index');
        
        // User Management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/{user}', [UserController::class, 'show'])->name('show');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
            Route::post('/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggle-status');
        });
        
        // Kategori Management
        Route::prefix('kategori')->name('kategori.')->group(function () {
            Route::get('/', [KategoriController::class, 'index'])->name('index');
            Route::get('/create', [KategoriController::class, 'create'])->name('create');
            Route::post('/', [KategoriController::class, 'store'])->name('store');
            Route::get('/{kategori}', [KategoriController::class, 'show'])->name('show');
            Route::get('/{kategori}/edit', [KategoriController::class, 'edit'])->name('edit');
            Route::put('/{kategori}', [KategoriController::class, 'update'])->name('update');
            Route::delete('/{kategori}', [KategoriController::class, 'destroy'])->name('destroy');
        });
        
        // Notifikasi Management
        Route::prefix('notifikasi')->name('notifikasi.')->group(function () {
            Route::get('/', [NotifikasiController::class, 'index'])->name('index');
            Route::get('/create', [NotifikasiController::class, 'create'])->name('create');
            Route::post('/', [NotifikasiController::class, 'store'])->name('store');
            Route::get('/{notifikasi}', [NotifikasiController::class, 'show'])->name('show');
            Route::get('/{notifikasi}/edit', [NotifikasiController::class, 'edit'])->name('edit');
            Route::put('/{notifikasi}', [NotifikasiController::class, 'update'])->name('update');
            Route::delete('/{notifikasi}', [NotifikasiController::class, 'destroy'])->name('destroy');
            Route::post('/{notifikasi}/send', [NotifikasiController::class, 'sendNotification'])->name('send');
            Route::post('/send-broadcast', [NotifikasiController::class, 'sendBroadcast'])->name('send-broadcast');
        });
        
        // Transaksi Management
        Route::prefix('transaksi')->name('transaksi.')->group(function () {
            Route::get('/', [TransaksiController::class, 'index'])->name('index');
            Route::get('/{transaksi}', [TransaksiController::class, 'show'])->name('show');
            Route::put('/{transaksi}/status', [TransaksiController::class, 'updateStatus'])->name('update-status');
            Route::get('/export/excel', [TransaksiController::class, 'exportExcel'])->name('export.excel');
            Route::get('/export/pdf', [TransaksiController::class, 'exportPdf'])->name('export.pdf');
            Route::get('/filter', [TransaksiController::class, 'filter'])->name('filter');
        });
        
        // Pajak Management - Perbaikan: hapus backslash di depan
        Route::prefix('pajak')->name('pajak.')->group(function () {
            Route::get('/', [IncomeController::class, 'index'])->name('index');
            Route::get('/show', [IncomeController::class, 'show'])->name('show');
            Route::get('/edit', [IncomeController::class, 'edit'])->name('edit');
            Route::put('/update', [IncomeController::class, 'update'])->name('update');
            Route::get('/history', [IncomeController::class, 'history'])->name('history');
        });
        
        // Reports
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/', [AdminController::class, 'reports'])->name('index');
            Route::get('/transactions', [AdminController::class, 'transactionReport'])->name('transactions');
            Route::get('/users', [AdminController::class, 'userReport'])->name('users');
            Route::get('/revenue', [AdminController::class, 'revenueReport'])->name('revenue');
        });
        
        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [AdminController::class, 'settings'])->name('index');
            Route::put('/update', [AdminController::class, 'updateSettings'])->name('update');
        });
    });
    
    // User routes (non-admin)
    Route::middleware('user')->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('dashboard');
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::get('/notifications', [UserController::class, 'notifications'])->name('notifications');
        Route::post('/notifications/{id}/read', [UserController::class, 'markAsRead'])->name('notifications.read');
    });
});

// API Routes for Mobile App (if needed)
Route::prefix('api')->middleware('api')->group(function () {
    Route::post('/login', [AuthController::class, 'apiLogin']);
    Route::post('/register', [AuthController::class, 'apiRegister']);
    
    Route::middleware('auth:api')->group(function () {
        Route::get('/user', [AuthController::class, 'apiUser']);
        Route::post('/logout', [AuthController::class, 'apiLogout']);
    });
});

// Fallback route
Route::fallback(function () {
    return redirect()->route('login');
});