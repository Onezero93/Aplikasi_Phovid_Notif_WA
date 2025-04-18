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
        if(Auth::attempt($request->only('username','password'))){
            if( Auth::user()->level == 'admin'){
                return redirect('/datapengguna')->with('success', 'Success Login As Admin!');
            }
            return redirect('/karyawan/tugas')->with('success', 'Succes Login As Karyawan!');
        }
        return redirect()->back()->withErrors('Username / Password is false');
        // return redirect('/');
    }

    //keluar akses
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
