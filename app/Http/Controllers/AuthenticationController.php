<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $login = $request->credential;
        $isEmail = filter_var($login, FILTER_VALIDATE_EMAIL);
        $credentialRule = 'required|max:255';
        $field = $isEmail ? 'email' : 'username';
        if ($isEmail) {
            $credentialRule .= '|email';
        }

        $validator = Validator::make($request->all(), [
            'credential' => $credentialRule,
            'password' => 'required',
        ], [
            'credential.email' => 'Harap masukan email yang valid',
            '*.required' => "Kolom :attribute harus diisi",
            '*.max' => ':attribute melebihi :max karakter',
        ], [
            'credential' => "Nama pengguna atau Email",
            'password' => "Password",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->onlyInput('credential');
        }

        if (Auth::attempt([$field => $login, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->intended('/')->with([
                'type' => 'success',
                'pesan' => 'Berhasil login'
            ]);
        }

        return redirect()->back()->onlyInput('credential')->with([
            'type' => 'danger',
            'pesan' => 'Username atau password salah, coba lagi'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
