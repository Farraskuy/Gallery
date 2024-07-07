<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JelajahiController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticationController::class, 'index'])->name('login');
    Route::post('login', [AuthenticationController::class, 'store']);

    Route::get('register', [RegisterController::class, 'index']);
    Route::post('register', [RegisterController::class, 'store']);
});

Route::get('jelajahi', [JelajahiController::class, 'index']);
Route::get('jelajahi/foto', [JelajahiController::class, 'foto']);
Route::get('jelajahi/album', [JelajahiController::class, 'album']);

Route::get('album/{album}', [PostController::class, 'detailAlbum']);
Route::get('foto/{foto}', [PostController::class, 'detailFoto']);

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout']);

    Route::get('get-started', [RegisterController::class, 'getStarted']);
    Route::post('get-started', [RegisterController::class, 'getStartedAction']);

    Route::get('post-creation', [PostController::class, 'create']);
    Route::post('post-creation', [PostController::class, 'store']);
    Route::get('post-creation/edit/{album}', [PostController::class, 'edit'])->middleware('onlyOwner');
    Route::put('post-creation/edit/{album}', [PostController::class, 'update'])->middleware('onlyOwner');
    Route::delete('post-creation/edit/{album}/foto/hapus/{foto}', [PostController::class, 'softDeleteImage'])->middleware('onlyOwner');

    Route::delete('album/delete/{album}', [PostController::class, 'destroy'])->middleware('onlyOwner');

    Route::delete('foto/komentar/hapus/{komentar}', [PostController::class, 'hapusKomentar']);
    Route::post('foto/komentar/{foto}', [PostController::class, 'komentar']);
    Route::post('foto/like/{foto}', [PostController::class, 'like']);

    Route::prefix('setting')->group(function () {
        Route::get('/', [SettingController::class, 'index']);
        Route::get('profil', [SettingController::class, 'index']);
        Route::post('profil', [SettingController::class, 'simpanProfil']);
        Route::get('akun', [SettingController::class, 'akun']);
        Route::post('akun', [SettingController::class, 'simpanAkun']);
        Route::get('reset-password', [SettingController::class, 'resetPassword']);
        Route::post('reset-password', [SettingController::class, 'aksiResetPassword']);
        Route::get('hapus-akun', [SettingController::class, 'hapusAkun']);
        Route::post('hapus-akun', [SettingController::class, 'aksiHapusAkun']);
    });
});

Route::get('{username}', [ProfileController::class, 'index']);
Route::get('{username}/album', [ProfileController::class, 'index']);
Route::get('{username}/foto', [ProfileController::class, 'foto']);
Route::get('{username}/report', [ProfileController::class, 'report'])->middleware('auth');
