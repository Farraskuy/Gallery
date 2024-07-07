<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;

class JelajahiController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->query('search', '');

        $album = Album::with(['foto' => function ($query) {
            $query->withCount('like');
            $query->withCount('komentar');
        }, 'user'])->orderBy('created_at', 'desc')->where('nama_album', 'like', "%$search%")->limit(8)->get();

        $fotos = Foto::with(['album' => function ($query) {
            $query->with('user');
        }])
            ->withCount('like')
            ->withCount('komentar')
            ->orderBy('created_at', 'desc')->where('judul_foto', 'like', "%$search%")->paginate(50)->withQueryString();

        if ($album->all() && $fotos->all()) {
            return view('pages.jelajahi.jelejahi', compact('album', 'fotos'));
        }

        return view('pages.jelajahi.empty-result');
    }

    public function album(Request $request)
    {
        $search = $request->query('search', '');

        $album = Album::with(['foto' => function ($query) {
            $query->withCount('like');
            $query->withCount('komentar');
        }, 'user'])->orderBy('created_at', 'desc')->where('nama_album', 'like', "%$search%")->paginate(50)->withQueryString();

        if ($album->all()) {
            return view('pages.jelajahi.jelajahi-album', compact('album'));
        }

        return view('pages.jelajahi.empty-result');
    }

    public function foto(Request $request)
    {
        $search = $request->query('search', '');

        $fotos = Foto::with(['album' => function ($query) {
            $query->with('user');
        }])
            ->withCount('like')
            ->withCount('komentar')
            ->orderBy('created_at', 'desc')->where('judul_foto', 'like', "%$search%")->paginate(50)->withQueryString();

        if ($fotos->all()) {
            return view('pages.jelajahi.jelajahi-foto', compact('fotos'));
        }

        return view('pages.jelajahi.empty-result');
    }
}
