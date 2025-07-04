<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Cek apakah email terdaftar sebagai admin
        $admin = Admin::where('email', $credentials['email'])->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Email tidak ditemukan di akun admin.']);
        }

        // Coba login via guard admin
        if (Auth::guard('admin')->attempt($credentials)) {
            // ✅ Pakai route langsung, bukan intended
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['password' => 'Password salah.']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
