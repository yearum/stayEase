<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // Pastikan file ini ada di resources/views/admin/login.blade.php
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        // ✅ DEBUG: Tambahkan ini untuk memastikan berhasil login
        if (Auth::guard('admin')->attempt($credentials)) {
            // Jika login berhasil, redirect ke dashboard admin
            return redirect()->route('admin.dashboard');
        }

        // Jika gagal login, kembalikan dengan error
        return back()->withErrors([
            'username' => 'Username atau password salah'
        ])->withInput();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Berhasil logout');
    }
}
