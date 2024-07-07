<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Models\Like;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    protected $user;
    public function __construct(Request $request)
    {
        $username = $request->route('username');

        $this->user = User::withCount('foto', 'album')
            ->where('username', '=', $username)
            ->firstOrFail();
    }

    public function index($username)
    {
        $user = $this->user;

        $post =  Album::with(['foto' => function ($query) {
            $query->withCount('like', 'komentar');
        }, 'user'])
            ->where('user_id', '=', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.profil.album', compact('user', 'username', 'post'));
    }

    public function foto($username)
    {
        $user = $this->user;

        $foto = Foto::with(['album' => function ($query) {
            $query->with('user');
        }])
            ->select('id', 'judul_foto', 'deskripsi_foto', 'lokasi_file', 'album_id')
            ->withCount('like')
            ->withCount('komentar')
            ->where('user_id', '=', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.profil.foto', compact('user', 'foto'));
    }

    public function report(Request $request)
    {
        $user = $this->user;
        if ($user->id != Auth::id()) {
            abort(403, 'Anda tidak dapat mengakses halaman ini');
        }

        $orderBy = $request->query('order_by');
        $direction = 'desc';
        if (!$orderBy) {
            $orderBy = 'created_at';
        }

        if ($request->query('direction')) {
            $direction = $request->query('direction');
        }

        $userReport = DB::table('album_report')
            ->selectRaw('COUNT(*) as total_album, SUM(jumlah_foto) as total_foto, SUM(jumlah_like) as total_like, SUM(jumlah_komentar) as total_komentar')
            ->where('user_id', '=', $user->id)
            ->first();


        $userReportDetail = DB::table('album_report')
            ->where('user_id', '=', $user->id)
            ->orderBy($orderBy, $direction)
            ->paginate(10)->withQueryString();

        return view('pages.profil.report', compact('user', 'userReport', 'userReportDetail'));
    }
}
