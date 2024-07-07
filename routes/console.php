<?php

use App\Models\Foto;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('image:clear', function () {
    $files = File::files(storage_path('app/public/upload'));
    foreach ($files as $value) {
        $fileFromDatabase = Foto::where('lokasi_file', '=', $value->getFilename())->first();
        if (!$fileFromDatabase && $value->getFilename() != 'default.png') {
            Storage::disk('public')->delete('upload/' . $value->getFilename());
            $this->info('Berhasil menghapus sampah ' . $value->getFilename());
        }
    }
})->purpose('Membersihkan gambar yang tidak di gunakan pada storage');
