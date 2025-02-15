<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class Otentikasi extends Controller
{
    public function otentikasi(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ],
        [
            'username.required' => 'Kolom Username harus diisi!',
            'password.required' => 'Kolom Password harus diisi!',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Alert::success('Berhasil', 'Kamu berhasil masuk ke dashboard admin!');
            return redirect()->intended('dashboard');
        }else {
    		Alert::error('Gagal!', 'Username/Password kamu salah, silahkan masuk ulang!');
            return back()->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Alert::success('Berhasil', 'Kamu berhasil keluar dari dashboard admin!');

        return redirect('/');
    }
}
