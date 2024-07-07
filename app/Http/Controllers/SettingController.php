<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.setting.profil', compact('user'));
    }

    public function simpanProfil(Request $request)
    {
        $validation = Validator::make($request->all(), [
            // rules
            'nama_lengkap' => 'required|max:255',
            'profil' => 'mimes:jpg,jpeg,png,gif|max:10240',
            'bio' => 'max:255',
        ], [
            // message
            '*.required' => 'Kolom :attribute harus diisi',
            'bio.max' => ':attribute melebihi :max karakter',
            'profil.mimes' => 'Harap pilih gambar yang bertype jpg, jpeg, png, atau gif',
            'profil.max' => 'Harap pilih gambar berukuran kurang dari 10 MB'
        ], [
            // custom input attribute name
            'nama_lengkap' => 'Nama lengkap',
            'profil' => 'Profil',
            'bio' => 'Bio',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $filename = Auth::user()->profil;
        $file = $request->file('profil');
        if (Auth::user()->profil != 'default.png' && ($file || $request->get('profil-saat-ini') == null)) {
            $filename = 'default.png';
            Storage::disk('public')->delete('profil/' . Auth::user()->profil);
        }

        if ($file) {
            $filename = hexdec(uniqid()) . '.' . $file->extension();
            $file->storeAs('public/profil', $filename);
        }

        $update = User::where('id', '=', Auth::id())->update([
            'nama_lengkap' => $request->nama_lengkap,
            'profil' => $filename,
            'bio' => $request->bio,
        ]);

        if (!$update) {
            return redirect()->back()->withInput()->with([
                'type' => 'danger',
                'pesan' => 'Profil gagal diperbarui, coba lagi nanti atau muat ulang website dan coba lagi'
            ]);
        }
        return redirect()->back()->with([
            'type' => 'success',
            'pesan' => 'Profil berhasil diperbarui'
        ]);
    }

    public function akun()
    {
        $user = Auth::user();
        return view('pages.setting.akun', compact('user'));
    }

    public function simpanAkun(Request $request)
    {
        $usernameRule = 'required|max:255';
        if (Auth::user()->username != $request->username) {
            $usernameRule .= '|unique:users,username';
        }

        $emailRule = 'required|email|max:255';
        if (Auth::user()->email != $request->email) {
            $emailRule .= '|unique:users,email';
        }

        $validator = Validator::make($request->all(), [
            'username' => $usernameRule,
            'email' => $emailRule,
        ], [
            '*.max' => ':attribute melebihi :max karakter',
            '*.required' => 'Kolom :attribute harus diisi',
            '*.unique' => ':attribute ":input" sudah digunakan',
            '*.email' => 'Harap masukan email yang valid',
        ], [
            'username' => "Username",
            'eamil' => "Email",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $update = User::where('id', '=', Auth::id())->update([
            'username' => $request->username,
            'email' => $request->email
        ]);

        if (!$update) {
            return redirect()->back()->withInput()->with([
                'type' => 'danger',
                'pesan' => 'Akun gagal diperbarui, coba lagi nanti atau muat ulang website dan coba lagi'
            ]);
        }
        return redirect()->back()->with([
            'type' => 'success',
            'pesan' => 'Akun berhasil diperbarui'
        ]);
    }

    public function resetPassword()
    {
        $user = Auth::user();
        return view('pages.setting.reset-pasword', compact('user'));
    }

    public function aksiResetPassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            // rules
            'password' => 'required',
            'password_repeat' => 'required|same:password'
        ], [
            // message  
            '*.required' => 'Kolom :attribute harus diisi',
            'password_repeat.same' => 'Password tidak sama',
        ], [
            // custom input attribute name
            'password' => 'Password',
            'password_repeat' => 'Ulangi Password'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $update = User::where('id', '=', Auth::id())->update([
            'password' => Hash::make($request->password)
        ]);

        if (!$update) {
            return redirect()->back()->withInput()->with([
                'type' => 'danger',
                'pesan' => 'Password gagal dirubah, coba lagi nanti atau muat ulang website dan coba lagi'
            ]);
        }
        return redirect()->back()->with([
            'type' => 'success',
            'pesan' => 'Password berhasil dirubah'
        ]);
    }

    public function hapusAkun()
    {
        $user = Auth::user();
        return view('pages.setting.hapus-akun', compact('user'));
    }

    public function aksiHapusAkun()
    {
        $user = User::findOrFail(Auth::id());
        $profil = $user->profil;
        
        $delete = $user->delete();

        if (!$delete) {
            return redirect()->back()->withInput()->with([
                'type' => 'danger',
                'pesan' => 'Akun gagal dihapus, coba lagi nanti atau muat ulang website dan coba lagi'
            ]);
        }
        Storage::disk('public')->delete('profil/' . $profil);

        return redirect()->back()->with([
            'type' => 'success',
            'pesan' => 'Akun berhasil dihapus'
        ]);

        return redirect()->back();
    }
}
