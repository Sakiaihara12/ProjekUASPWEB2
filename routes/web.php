<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Menu;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\RatingController;

// Admin Controllers
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RatingController as AdminRatingController;
use App\Http\Controllers\Auth\AdminLoginController;

// =====================================================================
// ✅ Halaman Awal (Welcome)
Route::get('/', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::guard('web')->check()) {
        return redirect()->route('dashboard');
    }

    return view('welcome');
});

// =====================================================================
// ✅ Dashboard User (Pembeli)
Route::get('/dashboard', function () {
    $menus = Menu::all();
    return view('dashboard', compact('menus'));
})->middleware(['auth', 'verified'])->name('dashboard');

// =====================================================================
// ✅ Area Pembeli (User) yang Sudah Login
Route::middleware(['auth'])->group(function () {
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Keranjang & Pemesanan
    Route::resource('cart', CartController::class)->only(['index', 'destroy']);
    Route::post('cart/add/{menu}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Riwayat Pesanan & Pesan Kembali
    Route::get('/orders/history', [OrderHistoryController::class, 'index'])->name('orders.history');
    Route::post('/orders/reorder/{order}', [OrderHistoryController::class, 'reorder'])->name('orders.reorder');

    // Kirim Rating
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
});

// =====================================================================
// ✅ Area Admin
Route::prefix('admin')->name('admin.')->group(function () {
    // ---------------------
    // 🔐 Login & Logout Admin
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login']);
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

    // ---------------------
    // 🛠️ Dashboard & Manajemen Admin (Harus Login Admin)
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', fn () => view('admin.dashboard'))->name('dashboard');

        // Pesanan masuk
        Route::get('pesanan', [OrderController::class, 'index'])->name('orders.index');

        // Kelola Menu (CRUD)
        Route::resource('menus', MenuController::class);

        // Lihat Rating dari Pembeli
        Route::get('ratings', [AdminRatingController::class, 'index'])->name('ratings.index');
    });
});

// =====================================================================
// ✅ Registrasi Admin Manual
Route::get('/admin/register', fn () => view('auth.admin-register'))->name('admin.register');
Route::post('/admin/register', function (Request $request) {
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

    return redirect()->route('admin.login')->with('success', 'Admin berhasil didaftarkan!');
});

// =====================================================================
// ✅ Auth Bawaan Laravel Breeze
require __DIR__.'/auth.php';
