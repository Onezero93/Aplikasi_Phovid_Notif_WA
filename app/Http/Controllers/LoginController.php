<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //masuk ke form login
    function index(){
        return view('auth.login');
    }

    //validaasi login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->status === 'admin') {
                return redirect()->route('dashboard');
            } elseif ($user->status === 'karyawan') {
                return redirect()->route('dashboard');
            } elseif ($user->status === 'pelanggan') {
                return redirect()->route('jasa.jasahome');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Status tidak dikenali.');
            }
        }

        return redirect()->route('login')->with('error', 'Username atau password salah.');
    }

    //keluar akses
    // public function logout(Request $request)
    // {
    //     Auth::logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect('/login');
    // }
     public function logout()
{
    // Simpan role sebelum logout
    $role = Auth::user()->status ?? null;

    Auth::logout();

    // Cek role: jika pelanggan, arahkan ke halaman utama pelanggan
    if ($role === 'pelanggan') {
        return redirect()->route('jasa.jasa'); // ke route '/'
    }

    // Default untuk admin dan lainnya
    return redirect()->route('login');
}
}
