<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RatingController as AdminRatingController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Models\Menu;

// ✅ Halaman utama: redirect otomatis kalau sudah login
Route::get('/', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::guard('web')->check()) {
        return redirect()->route('dashboard');
    }

    return view('welcome');
});

// ✅ Dashboard pembeli (user)
Route::get('/dashboard', function () {
    $menus = Menu::all();
    return view('dashboard', compact('menus'));
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Area pembeli (user) yang sudah login
Route::middleware(['auth'])->group(function () {
    // Profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Keranjang & pemesanan
    Route::resource('cart', CartController::class)->only(['index', 'destroy']);
    Route::post('cart/add/{menu}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Riwayat Pesanan & Pesan Kembali
    Route::get('/orders/history', [OrderHistoryController::class, 'index'])->name('orders.history');
    Route::post('/orders/reorder/{order}', [OrderHistoryController::class, 'reorder'])->name('orders.reorder');

    // Rating (user mengirimkan rating)
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
});

// ✅ Area admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Login & logout admin
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login']);
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Admin yang sudah login
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', fn () => view('admin.dashboard'))->name('dashboard');
        Route::get('pesanan', [OrderController::class, 'index'])->name('orders.index');
        Route::resource('menus', MenuController::class);

        // ✅ Route melihat semua rating pembeli
        Route::get('ratings', [AdminRatingController::class, 'index'])->name('ratings.index');
    });
});

// ✅ Daftar admin manual
Route::get('/admin/register', fn () => view('auth.admin-register'));
Route::post('/admin/register', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:admins',
        'password' => 'required|min:6|confirmed',
    ]);

    \App\Models\Admin::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return redirect('/admin/login')->with('success', 'Admin berhasil didaftarkan!');
});

// ✅ Auth bawaan Laravel Breeze
require __DIR__.'/auth.php';
