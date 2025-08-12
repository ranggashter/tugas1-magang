<?php
// routes/web.php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect('/login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Routes (Role-based)
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
        ->middleware('role:admin')->name('admin.dashboard');
    Route::get('/manajer/dashboard', [DashboardController::class, 'manajer'])
        ->middleware('role:manajer')->name('manajer.dashboard');
    Route::get('/staff/dashboard', [DashboardController::class, 'staff'])
        ->middleware('role:staff')->name('staff.dashboard');

    // Admin Only Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('users', UserController::class);
    });

    // Admin & Manajer Routes
    Route::middleware(['role:admin,manajer'])->group(function () {
        Route::resource('products', ProductController::class);
        
        // Stock Management
        Route::get('/stock-in', [StockController::class, 'stockInIndex'])->name('stock-in.index');
        Route::get('/stock-in/create', [StockController::class, 'stockInCreate'])->name('stock-in.create');
        Route::post('/stock-in', [StockController::class, 'stockInStore'])->name('stock-in.store');
        
        Route::get('/stock-out', [StockController::class, 'stockOutIndex'])->name('stock-out.index');
        Route::get('/stock-out/create', [StockController::class, 'stockOutCreate'])->name('stock-out.create');
        Route::post('/stock-out', [StockController::class, 'stockOutStore'])->name('stock-out.store');
        
        Route::get('/stock-opname', [StockController::class, 'stockOpnameIndex'])->name('stock-opname.index');
        Route::get('/stock-opname/create', [StockController::class, 'stockOpnameCreate'])->name('stock-opname.create');
        Route::post('/stock-opname', [StockController::class, 'stockOpnameStore'])->name('stock-opname.store');

        // Reports
        Route::get('/reports/stock', [ReportController::class, 'stock'])->name('reports.stock');
        Route::get('/reports/stock-in', [ReportController::class, 'stockIn'])->name('reports.stock-in');
        Route::get('/reports/stock-out', [ReportController::class, 'stockOut'])->name('reports.stock-out');
    });

    // Staff Routes (Confirmation)
    Route::middleware(['role:staff'])->group(function () {
        Route::post('/stock-in/{id}/confirm', [StockController::class, 'confirmStockIn'])->name('stock-in.confirm');
        Route::post('/stock-out/{id}/confirm', [StockController::class, 'confirmStockOut'])->name('stock-out.confirm');
    });
});