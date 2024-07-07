@extends('pages.post.post-creation-layout')

@section('content')
    <nav class="fixed-top navbar navbar-expand-lg" style="top: 20px">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="navbar-nav d-flex justify-content-between w-100 px-4">
                    <div class="nav-item">
                        <button onclick="window.location.href='{{ url()->previous() == url()->current() ? url('/') : url()->previous() }}'" class="btn fs-14px border rounded-pill fw-semibold px-4 py-2">Batalkan</button>
                    </div>
                    <div class="nav-item">
                        <button class="btn fs-14px btn-dark rounded-pill fw-semibold px-4 py-2 btn-lanjut" data-bs-toggle="modal" data-bs-target="#modal-album">Lanjutkan</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <input type="file" id="foto" multiple hidden>
    <form class="form-post" onsubmit="(event) => event.preventDefault()" enctype="multipart/form-data" method="post" style="padding-top: 100px; height: 100vh">
        <div class="col-8 mx-auto mb-3">
            <span>Nama album</span>
            <input type="text" class="form-control rounded-0 border-0 border-bottom shadow-none fw-semibold nama-album" value="{{ old('nama_album', $album->nama_album) }}" name="nama_album" placeholder="Berikan nama pada album" style="font-size: 30px">
        </div>
        <div class="d-flex h-100">
            <div class="h-100 overflow-auto border-end px-3" style="width: 300px">
                <label for="foto" class="w-100 card-tambah rounded-4 p-3 mb-3" style="cursor: pointer;">
                    <div class="btn btn-dark rounded-circle btn-tambah mb-2 p-0"><i class="fa-regular fa-plus fs-5"></i></div>
                    <h5 class="fs-14px fw-semibold">Tambah Gambar</h5>
                </label>
                <div>
                    @csrf
                    @method('PUT')
                    {{-- @dump($album, $album->foto) --}}
                    {{-- @dump(Session::get('foto_terhapus', [])) --}}
                    <div class="list-image">
                        @foreach ($album->foto as $foto)
                            <div class="card-image mb-3 rounded-4 is-invalid {{ collect(Session::get('foto_terhapus', []))->contains($foto->lokasi_file) ? 'd-none' : '' }}">
                                <img class="h-100 w-100 object-fit-cover rounded-4 p-1 image show" src="{{ asset('storage/upload/' . $foto->lokasi_file) }}">
                                <input value="{{ $foto->judul_foto }}" class="judul focus opacity-0 position-absolute w-0 h-0" style="cursor: default" type="text" readonly name="judul[{{ $loop->index }}]">
                                <input value="{{ $foto->deskripsi_foto }}" class="keterangan" type="text" name="keterangan[{{ $loop->index }}]" hidden>
                                <input class="foto-saat-ini" type="text" name="foto_saat_ini[{{ $loop->index }}]" value="{{ $foto->lokasi_file }}" hidden>
                                <input class="file-image" type="file" name="foto[{{ $loop->index }}]" hidden>
                                <form action=""></form>
                                <form class="form-delete" action="{{ url()->current() . '/foto/hapus/' . $foto->lokasi_file }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="btn" class="btn btn-danger btn-hapus"><i class="fa-solid fa-xmark"></i></button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <div class="modal fade" id="modal-album" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-4 rounded-4">
                                <h4 class="fw-semibold mb-4">Sentuhan Terakhir</h4>
                                <p class="fs-14px">Informasi album</p>
                                <fieldset class="fieldset-album">
                                    <div class="mb-4">
                                        <label class="form-label fs-14px fw-semibold" for="deskripsi_album">Deskripsi album</label>
                                        <textarea class="form-control form-textarea rounded-4 p-3 fs-14px" style="resize: vertical" id="deskripsi_album" name="deskripsi_album" cols="30" rows="4">{{ old('deskripsi_album', $album->deskripsi) }}</textarea>
                                        <div class="invalid-feedback">
                                            Harap isi kolom ini
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="text-end">
                                    <button type="button" class="btn fs-14px border rounded-pill fw-semibold px-4 py-2" data-bs-dismiss="modal">Batal</button>
                                    <button type="button" class="btn fs-14px btn-dark rounded-pill fw-semibold px-4 py-2 btn-submit">Simpan <i class="fa-duotone fa-spinner-third fa-spin" style="opacity: 0; width: 0"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col px-3 h-100 overflow-auto">
                <div class="position-relative mb-4 rounded-4 p-2 preview-image-wrapper d-flex flex-column align-items-center justify-content-center">
                    <div class="mb-2 w-100" style="height: 300px">
                        <img class="w-100 h-100 object-fit-contain rounded-4 preview-image d-none">
                    </div>
                    <div class="mb-2 empty-preview text-center" style="height: 300px">
                        <p class="fa-duotone fa-images mb-3" style="font-size: 80px"></i>
                        <p class="fs-14px">Pilih gambar kotak kiri memilih foto</p>
                    </div>
                    <button class="btn btn-outline-dark btn-pagination sebelum"><i class="fa-solid fa-arrow-left"></i></button>
                    <button class="btn btn-outline-dark btn-pagination sesudah"><i class="fa-solid fa-arrow-right"></i></button>
                    <div class="d-flex gap-2 justify-content-end w-100">
                        <button type="button" class="fs-14px btn fw-semibold px-4 py-2 rounded-pill border btn-hapus-preview">Hapus Gambar</button>
                        <button type="button" class="fs-14px btn fw-semibold px-4 py-2 rounded-pill btn-dark btn-ubah-preview">Ubah Gambar</button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="judul" class="form-label fs-14px fw-semibold">Judul Foto</label>
                    <input type="text" id="judul" class=" form-control form-control-lg rounded-pill fs-14px ">
                    <div class="form-text">*Jika tidak diisi maka judul foto akan menggunakan nama album. Contoh: <span class="fw-semibold">Nama album - 1</span></div>
                </div>
                <div class="mb-4">
                    <label class="form-label fs-14px fw-semibold" for="keterangan">Keterangan</label>
                    <textarea placeholder="optional" class="form-control form-textarea rounded-4 p-3 fs-14px " style="resize: vertical" id="keterangan" cols="30" rows="4"></textarea>
                </div>
            </div>
        </div>
        </div>
    @endsection
