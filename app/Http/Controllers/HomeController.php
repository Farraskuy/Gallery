<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $album = Album::with(['foto' => function ($query) {
            $query->withCount('like');
            $query->withCount('komentar');
        }, 'user'])->orderBy('created_at', 'desc')->limit(8)->get();

        $fotos = Foto::with(['album' => function ($query) {
            $query->with('user');
        }])
            ->withCount('like')
            ->withCount('komentar')
            ->orderBy('created_at', 'desc')->paginate(50);

        return view('pages.home', compact('album', 'fotos'));
    }
}
