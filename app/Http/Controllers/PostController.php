<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Models\Komentar;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $album = Album::all();
        return view('pages.post.post-creation', compact('album'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all(), $request->files, $request->file('foto'));
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            // rules
            'judul.*' => 'max:255',
            'keterangan.*' => 'max:255',
            'nama_album.*' => 'required|max:255',
            'deskripsi_album.*' => 'max:255',
            'foto.*' => 'mimes:jpg,jpeg,png,gif|max:10240'
        ], [
            // message
            '*.*.required' => 'Harap isi kolom yang tersedia',
            '*.*.max' => 'Harap memasukan kata pada input maximal 255 karakter',
            'foto.*.max' => 'Harap ukuran file maximal 10MB',
            'foto.*.mimes' => 'Harap pilih gambar yang bertype jpg, jpeg, png, atau gif',
        ], [
            // custom input attribute name
            'judul' => 'Judul',
            'keterangan' => 'Keterangan',
            'nama_album' => 'Nama album',
            'deskripsi_album' => 'Deskripsi album',
            'foto' => 'foto',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $userId = Auth::id();

        $album = Album::create([
            'nama_album' => $request->nama_album,
            'deskripsi' => $request->deskripsi_album,
            'user_id' => $userId
        ]);

        $albumID = $album->id;

        for ($i = 0; $i < count($request->judul); $i++) {
            $file = $request->file('foto.' . $i);
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/upload', $filename);

            $judul = $request->judul[$i] ?? $request->nama_album . ' - ' . ($i + 1);

            Foto::create([
                'album_id' => $albumID,
                'user_id' => $userId,
                'judul_foto' => $judul,
                'deskripsi_foto' => $request->keterangan[$i],
                'lokasi_file' => $filename,
            ]);
        }

        return redirect()->to(Auth::user()->username)->with([
            'type' => 'success',
            'pesan' => 'Berhasil membuat postingan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function detailAlbum($album)
    {
        $album = Album::with(['foto' => function ($query) {
            $query->withCount('like', 'komentar');
            $query->with('komentar.user');
        }, 'user'])->where('id', '=', $album)->firstOrFail();

        // dd($album);
        return view('pages.post.album', compact('album'));
    }

    /**
     * Display the specified resource.
     */
    public function detailFoto($foto)
    {
        $foto = Foto::with(['album' => function ($query) {
            $query->with('user');
            $query->with(['foto' => function ($query) {
                $query->withCount('komentar', 'like');
            }]);
        }])
            ->withCount('like', 'komentar')
            ->orderBy('created_at', 'desc')->where('id', '=', $foto)->first();

        // dd($foto);
        return view('pages.post.foto', compact('foto'));
    }

    /**
     * show edit field.
     */
    public function edit(Album $album)
    {
        if (!Session::get('lanjut')) {
            Session::forget('foto_terhapus');
        }

        return view('pages.post.post-creation-edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        // dd($request->all(), $album, Session::get('foto_terhapus'));

        $validation = Validator::make($request->all(), [
            // rules
            'judul.*' => 'max:255',
            'keterangan.*' => 'max:255',
            'judul_album.*' => 'required|max:255',
            'deskripsi_album.*' => 'max:255',
            'foto.*' => 'mimes:jpg,jpeg,png,gif|max:10240'
        ], [
            // message
            '*.*.required' => 'Harap isi kolom yang tersedia',
            '*.*.max' => 'Harap memasukan kata pada input maximal 255 karakter',
            'foto.*.max' => 'Harap ukuran file maximal 10MB',
            'foto.*.mimes' => 'Harap pilih gambar yang bertype jpg, jpeg, png, atau gif',
        ], [
            // custom input attribute name
            'judul' => 'Judul',
            'keterangan' => 'Keterangan',
            'judul_album' => 'Judul album',
            'deskripsi_album' => 'Deskripsi album',
            'foto' => 'foto',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $album->update([
            'nama_album' => $request->nama_album,
            'deskripsi' => $request->deskripsi_album,
        ]);

        $number = 1;
        foreach ($request->judul as $key => $value) {
            // create foto baru jika belum ada
            if (!isset($request->foto_saat_ini[$key])) {
                $file = $request->file('foto')[$key];
                $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/upload', $filename);

                $judul = $value ? $value : $request->nama_album . ' - ' . $number;

                Foto::create([
                    'album_id' => $album->id,
                    'user_id' => Auth::id(),
                    'judul_foto' => $judul,
                    'deskripsi_foto' => $request->keterangan[$key],
                    'lokasi_file' => $filename
                ]);

                $number++;
                continue;
            }

            // hapus foto yang terdapat pada session 
            $fotoSaatIni = Foto::where('album_id', '=', $album->id)->where('lokasi_file', '=', $request->foto_saat_ini[$key])->first();
            if (collect(Session::get('foto_terhapus', []))->contains($request->foto_saat_ini[$key])) {
                $filename = $fotoSaatIni->lokasi_file;
                $fotoSaatIni->delete();

                Storage::drive('public')->delete('upload/' . $filename);

                continue;
            }

            // update foto
            $filename = $fotoSaatIni->lokasi_file;
            if (isset($request->file('foto')[$key])) {
                $file = $request->file('foto')[$key];
                $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/upload', $filename);

                $filenameLama = $fotoSaatIni->lokasi_file;

                Storage::drive('public')->delete('upload/' . $filenameLama);
            }

            $judul = $value;
            if (!$value) {
                $judul = $request->nama_album . ' - ' . $key;
                $number++;
            }

            $fotoSaatIni->update([
                'judul_foto' => $judul,
                'deskripsi_foto' => $request->keterangan[$key],
                'lokasi_file' => $filename
            ]);
        }

        return redirect()->to(Auth::user()->username)->with([
            'pesan' => 'Berhasil memperbarui postingan',
            'type' => 'success'
        ]);
    }

    public function softDeleteImage(Album $album, $foto)
    {
        $foto = $album->foto->where('lokasi_file', '=', $foto)->first();
        if ($foto) {
            Session::push('foto_terhapus', $foto->lokasi_file);
        }

        return redirect()->back()->with('lanjut', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        foreach ($album->foto as $value) {
            Storage::disk('public')->delete('upload/' . $value->lokasi_file);
        }

        $aksi = $album->delete();

        if (!$aksi) {
            return redirect()->back()->withInput()->with([
                'type' => 'danger',
                'pesan' => 'Gagal menghapus album, coba lagi nanti atau muat ulang website dan coba lagi'
            ]);
        }

        return redirect()->back()->withInput()->with([
            'type' => 'success',
            'pesan' => 'Behasil menghapus album'
        ]);
    }

    public function like(Request $request, Foto $foto)
    {
        $liked = $foto->like->where('user_id', '=', Auth::id())->first();
        if ($liked) {
            $liked->delete();
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'foto_id' => $foto->id
            ]);
        }

        return redirect()->back()->with('swiper_index', $request->swiper_index);
    }

    public function komentar(Request $request, Foto $foto)
    {
        $validation = Validator::make($request->all(), [
            // rules
            'komentar' => 'required'
        ], [
            // message
            '*.required' => 'Harap isi kolom :attribute'
        ], [
            // custom input attribute name
            'komentar' => 'Komentar'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->with([
                'swiper_index', $request->swiper_index
            ]);
        }

        Komentar::create([
            'user_id' => Auth::id(),
            'foto_id' => $foto->id,
            'isi_komentar' => $request->komentar
        ]);

        return redirect()->back()->with([
            'swiper_index', $request->swiper_index
        ]);
    }

    public function hapusKomentar(Komentar $komentar)
    {
        if ($komentar->foto->user_id != Auth::id() && $komentar->user_id != Auth::id()) {
            abort(403, "Anda tidak dapat melakukan perintah ini");
        }

        $komentar = $komentar->delete();

        if (!$komentar) {
            return redirect()->back()->with([
                'type' => 'danger',
                'pesan' => 'Gagal menghapus komentar, coba lagi nanti atau muat ulang website dan coba lagi'
            ]);
        }

        return redirect()->back()->with([
            'type' => 'success',
            'pesan' => 'Behasil menghapus komentar'
        ]);
    }
}
