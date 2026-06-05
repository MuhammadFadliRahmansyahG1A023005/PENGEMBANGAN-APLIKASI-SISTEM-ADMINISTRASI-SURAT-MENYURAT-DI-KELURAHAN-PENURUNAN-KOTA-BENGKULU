<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginproses(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('panel');
        } else {
            return back()->with('error', 'Login Gagal, pastikan Nomor Telpon/Email dan password benar!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerproses(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:3',
            'jeniskelamin' => 'required',
            'alamat_jalan' => 'required',
            'rt' => 'required',
            'rw' => 'required',
        ], [
            'email.unique' => 'Nomor Telpon atau Email yang Anda masukkan sudah terdaftar. Silakan gunakan yang lain atau masuk ke akun Anda.'
        ]);

        $full_alamat = $request->alamat_jalan . ' RT ' . $request->rt . ' RW ' . $request->rw;

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $full_alamat,
            'nik' => '-',
            'nokk' => '-',
            'jeniskelamin' => $request->jeniskelamin,
            'password' => Hash::make($request->password),
            'role' => 'Warga',
        ];

        User::create($data);

        return redirect('login')->with('success', 'Akun berhasil dibuat! Anda otomatis masuk ke data warga. Silakan login.');
    }
}
