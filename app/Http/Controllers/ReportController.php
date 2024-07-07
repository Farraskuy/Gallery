<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    protected $user;
    protected $userData;
    protected $userDataByDate;

    public function __construct(Request $request)
    {
        $username = $request->route('username');

        $this->user = User::withCount('foto', 'album')
            ->where('username', '=', $username)
            ->firstOrFail();

        $userData = User::withCount('foto', 'album')->with([
            'foto' => function ($query) {
                $query->withCount('like', 'komentar');
            },
        ])->first();

        $userData->total_like = $userData->foto->sum('like_count');
        $userData->total_komentar = $userData->foto->sum('komentar_count');

        $this->userData = $userData;
    }

    public function index(Request $request)
    {
        
    }

    public function album(Request $request)
    {
        $user = $this->user;
        $userData = $this->userData;
        $userDataByDate = $this->userDataByDate;

        $waktu = $request->query('waktu');
        $arrayWaktu = explode(' - ', $waktu);

        $waktuAwal = Carbon::now()->firstOfMonth()->format('Y-m-d');
        if (isset($arrayWaktu[0]) && $arrayWaktu[0]) {
            $waktuAwal = str_replace('/', '-', $arrayWaktu[0]);
        }

        $waktuAkhir = Carbon::now()->format('Y-m-d');
        if (isset($arrayWaktu[1]) && $arrayWaktu[1]) {
            $waktuAkhir = str_replace('/', '-', $arrayWaktu[1]);
        }

        $album = Album::withCount('foto')->whereRaw("date(created_at) between date('$waktuAwal') and date('$waktuAkhir')");

        return view('pages.profil.report', compact('userData', 'userDataByDate'));
    }
}
