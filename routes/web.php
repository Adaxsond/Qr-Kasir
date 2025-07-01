<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| HALAMAN PELANGGAN
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('order.index', ['tableNumber' => 1]); // Default tableNumber = 1
});

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::get('/cart', [OrderController::class, 'cart'])->name('order.cart');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/{order}/status', [OrderController::class, 'status'])->name('order.status');

/*
|--------------------------------------------------------------------------
| HALAMAN ADMIN & KASIR (GABUNG)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', CheckRole::class . ':admin,kasir'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/orders/{order}', [AdminController::class, 'show'])->name('orders.show');
        Route::post('/orders/{order}/status', [AdminController::class, 'updateStatus'])->name('orders.updateStatus');

        // Hanya admin yang bisa akses kategori & produk
        Route::resource('categories', CategoryController::class)->middleware(CheckRole::class . ':admin');
        Route::resource('products', ProductController::class)->middleware(CheckRole::class . ':admin');

        // Laporan - bisa diakses admin & kasir
        Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');
        Route::get('/laporan/print', [AdminController::class, 'printLaporan'])->name('laporan.print');
    });

/*
|--------------------------------------------------------------------------
| RUTE REDIRECT DASHBOARD BREEZE
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role === 'kasir') {
            return redirect()->route('admin.dashboard'); // kasir pakai route yang sama
        }
    }
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| HALAMAN PEMBAYARAN
|--------------------------------------------------------------------------
*/
Route::get('/qris-payment', fn () => view('qris_payment'))->name('qris.payment');
Route::get('/order_success', fn () => view('order_success'))->name('order.success');
Route::get('/dana-payment', fn () => view('dana_payment'));
Route::get('/bri-payment', fn () => view('bri_payment'));

require __DIR__.'/auth.php';
