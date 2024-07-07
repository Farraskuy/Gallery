<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            // rules
            'nama_lengkap' => 'required|max:255',
            'username' => 'required|unique:users,username|max:255|regex:/^[\w\d\S]+$/',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required',
            'password_repeat' => 'required|same:password'
        ], [
            // message
            '*.max' => ':attribute melebihi :max karakter',
            'username.regex' => 'Harap isi kolom username dengan huruf a-Z dan 0-9 tanpa spasi',
            '*.required' => 'Kolom :attribute harus diisi',
            '*.unique' => ':attribute ":input" sudah digunakan',
            '*.email' => 'Harap masukan email yang valid',
            'password_repeat.same' => 'Password tidak sama',
        ], [
            // custom input attribute name
            'nama_lengkap' => 'Nama lengkap',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Ulangi Password'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $stored = User::create($request->all());

        if (!$stored) {
            return redirect()->back()->withErrors($validation)->withInput()->with([
                'type' => 'danger',
                'pesan' => 'Gagal membuat akun, coba lagi nanti atau muat ulang website dan coba lagi'
            ]);
        }
        Auth::login($stored);

        return redirect()->to('get-started');
    }

    public function getStarted()
    {
        $user = Auth::user();
        return view('auth.get-started', compact('user'));
    }

    public function getStartedAction(Request $request)
    {
        $validation = Validator::make($request->all(), [
            // rules
            'profil' => 'mimes:jpg,jpeg,png,gif|max:10240',
            'bio' => 'max:255',
        ], [
            // message
            'bio.max' => ':attribute melebihi :max karakter',
            'profil.mimes' => 'Harap pilih gambar yang bertype jpg, jpeg, png, atau gif',
            'profil.max' => 'Harap pilih gambar berukuran kurang dari 10 MB'
        ], [
            // custom input attribute name
            'profil' => 'Profil',
            'bio' => 'Bio',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $filename = 'default.png';
        $file = $request->file('profil');
        if ($file) {
            $filename = hexdec(uniqid()) . '.' . $file->extension();
            $file->storeAs('public/profil', $filename);
        }

        if (Auth::user()->profil != 'default.png') {
            Storage::disk('public')->delete('profil/' . Auth::user()->profil);
        }

        $update = User::where('id', '=', Auth::id())->update([
            'bio' => $request->bio,
            'profil' => $filename
        ]);

        if (!$update) {
            return redirect()->back()->withInput()->with([
                'type' => 'danger',
                'pesan' => 'Profil gagal disimpan, coba lagi nanti atau muat ulang website dan coba lagi'
            ]);;
        }
        return redirect()->to('/');
    }
}
