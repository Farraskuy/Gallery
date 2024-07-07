@extends('pages.layout')

@section('title', 'Foto ' . $foto->judul_foto . ' | Gallery')
@section('section')
    <div class="container pt-3 pb-4">
        <div class="row d-flex g-0 w-100 shadow rounded-4 position-relative" style="min-height: 500px;">
            {{-- @dd($album) --}}
            <div class="col-12 col-lg-8 rounded-start position-relative p-3 pe-lg-0" style="height: 500px">
                <div class="swiper h-100 w-100 rounded">
                    <div class="swiper-wrapper swiper-wrapper-foto">

                        <div class="swiper-slide rounded position-relative bg-light">
                            <img class="w-100 h-100 object-fit-contain" style="filter: brightness(0.95)" src="{{ asset('storage/upload/' . $foto->lokasi_file) }}" alt="">
                            <div class="d-flex gap-2 position-absolute me-4 mb-4" style="bottom: 0; right: 0">
                                <button class="btn-refit btn bg-white rounded p-0 d-flex align-items-center justify-content-center" style="height: 40px; width: 40px;"><i class="fa-solid fa-minimize"></i></button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="btn border button-prev position-absolute bg-white rounded-circle p-0 ms-4 d-flex align-items-center justify-content-center" style="height: 40px; width: 40px; transform:translateY(-50%); top: 50%; left: 0; z-index: 1"><i class="fa-regular fa-chevron-left"></i></div>
                <div class="btn border button-next position-absolute bg-white rounded-circle p-0 me-4 d-flex align-items-center justify-content-center" style="height: 40px; width: 40px; transform:translateY(-50%); top: 50%; right: 0; z-index: 1"><i class="fa-regular fa-chevron-right"></i></div>
            </div>
            <div class="col-12 col-lg-4 h-100 overflow-y-auto position-relative pt-lg-3" style="min-height: 500px">
                <div class="p-3 pb-0">
                    <a href="{{ url($foto->album->user->username) }}" class="mb-3 d-flex gap-2 text-decoration-none text-dark">
                        <img src="{{ asset('storage/profil/' . $foto->album->user->profil) }}" class="rounded-circle object-fit-cover" height="50" width="50">
                        <div class="d-flex flex-column justify-content-center">
                            <p class="m-0 wrap-text fw-semibold fs-14px">{{ $foto->album->user->nama_lengkap }}</p>
                            <p class="m-0 wrap-text fw-semibold text-secondary fs-13px">{{ $foto->album->user->username }}</p>
                        </div>
                    </a>
                    <div class="mb-3">
                        <span>Album</span>
                        <a href="{{ url('album/' . $foto->album->id) }}" class="d-flex gap-2 text-decoration-none">
                            <div class="border rounded-3 p-1">
                                <img src="{{ asset('storage/upload/' . $foto->album->foto[0]->lokasi_file) }}" alt="{{ $foto->album->foto[0]->lokasi_file }}" class="object-fit-cover rounded-2" width="50" height="50">
                            </div>
                            <div class="d-flex justify-content-center flex-column">
                                <div class="d-flex align-items-center justify-content-start gap-2 text-secondary fs-13px text-nowrap">
                                    <p class="m-0 fw-semibold"><i class="fa-solid fa-comment"></i> {{ convertNumberToShortFormat($foto->album->foto->sum('komentar_count')) }} Komentar</p>
                                    <p class="m-0 fw-semibold"><i class="fa-solid fa-image"></i> {{ convertNumberToShortFormat($foto->album->foto->count()) }} Foto</p>
                                    <p class="m-0 fw-semibold"><i class="fa-solid fa-heart"></i> {{ convertNumberToShortFormat($foto->album->foto->sum('like_count')) }} Suka</p>
                                </div>
                                <p class="fw-semibold fs-15px judul-foto wrap-text m-0 text-dark" style="-webkit-line-clamp:2">{{ $foto->album->nama_album }}</p>
                            </div>
                        </a>
                    </div>
                    <span>Foto</span>
                    <div class="d-flex align-items-center justify-content-start gap-2 text-secondary fs-14px text-nowrap">
                        <p class="m-0 fw-semibold"><i class="fa-solid fa-comment"></i> {{ convertNumberToShortFormat($foto->komentar_count) }} Komentar</p>
                        <p class="m-0 fw-semibold"><i class="fa-solid fa-heart"></i> {{ convertNumberToShortFormat($foto->like_count) }} Suka</p>
                    </div>
                    <h3 class="fw-semibold wrap-text" style="-webkit-line-clamp:3">{{ $foto->album->nama_album }}</h3>
                    <p class="fw-semibold fs-14px text-secondary overflow-y-auto" style="max-height: 150px">{{ $foto->album->deskripsi }}</p>
                </div>

                <div class="detail-foto-wrapper">

                    <div class="detail-foto">
                        <div class="px-3">

                            <form action="{{ url('foto/like/' . $foto->id) }}" class="border-top border-bottom mb-3 d-flex align-items-center" method="post">
                                @csrf
                                <a href="#komentar-foto-{{ $foto->lokasi_file }}" class="border-end p-3 h-100 btn rounded-0 border-0 m-0 fw-semibold d-flex align-items-center gap-2 justify-content-center align-items-lg-center fs-15px text-decoration-none" style="width: 50px"><i class="fa-regular fa-comment" style="font-size: 20px"></i></a>
                                <button class="text-start flex-grow-1 p-3 h-100 btn rounded-0 border-0 m-0 fw-semibold d-flex align-items-center gap-2 justify-content-center align-items-lg-center fs-15px">
                                    <i class="fa-heart {{ $foto->like->where('user_id', '=', Auth::id())->first() ? 'fa-solid text-danger' : 'fa-regular' }}" style="font-size: 20px"></i>
                                    <span class="fs-14px">
                                        @if ($foto->like->where('user_id', '=', Auth::id())->first() && $foto->like_count > 1)
                                            Anda dan {{ convertNumberToShortFormat($foto->like_count - 1) }} lainnya menyukai foto ini
                                        @elseif ($foto->like->where('user_id', '=', Auth::id())->first())
                                            Anda menyukai foto ini
                                        @else
                                            {{ convertNumberToShortFormat($foto->like_count) }} Suka
                                        @endif
                                    </span>

                                </button>
                            </form>
                            <p class="fs-14px deskripsi-foto overflow-y-auto" style="max-height: 150px"><span class="fw-semibold">Deskripsi: </span> {{ $foto->deskripsi_foto ? $foto->deskripsi_foto : '-' }}</p>

                            <p class="mb-2" id="komentar-foto-{{ $foto->lokasi_file }}">Komentar <span class="fs-14px">({{ convertNumberToShortFormat($foto->komentar->count()) }})</span></p>
                            
                            <div class="overflow-y-auto px-2" style="min-height: 150px; max-height: 500px">
                                @foreach ($foto->komentar as $komentar)
                                    <div class="mb-3 d-flex gap-2 ">
                                        <a href="{{ url($komentar->user->username) }}" style="height: fit-content">
                                            <img src="{{ asset('storage/profil/' . $komentar->user->profil) }}" class="rounded-circle object-fit-cover mt-2" height="30" width="30">
                                        </a>
                                        <div class="d-flex flex-column justify-content-center bg-light rounded p-2">
                                            <a href="{{ url($komentar->user->username) }}" class="text-decoration-none text-dark m-0 wrap-text fw-semibold fs-13px">{{ $komentar->user->nama_lengkap }}</a>
                                            <p class="m-0  fs-13px" style="-webkit-line-clamp:">{{ $komentar->isi_komentar }}</p>
                                            <div class="d-flex justify-content-between" style="height: fit-content">
                                                @php
                                                    $diff = simpleTimeDiffFromTimestamp(now()->timestamp, strtotime($komentar->created_at));
                                                @endphp
                                                <p class="m-0 fs-12px text-secondary fw-semibold">{{ $diff ? $diff . ' lalu' : 'Baru saja' }}</p>
                                                @if ($komentar->user_id == Auth::id() || $foto->user_id == Auth::id())
                                                    <div class=" ps-2 border-2 dropdown" style="cursor: pointer">
                                                        <button class="btn p-0 m-0 d-flex align-items-center justify-content-center btn-light" style="height: 20px; width: 20px;" data-bs-toggle="dropdown" data-bs-display="static"><i class="fa-regular fa-ellipsis"></i></button>
                                                        <div class=" dropdown-menu dropdown-menu-end dropdown-menu-profil p-2 d-flex flex-column bg-white shadow mb-2" style="top: calc(100% + 10px); transform: translateX(50%); z-index: 2;">
                                                            <form action="{{ url('foto/komentar/hapus/' . $komentar->id) }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="btn btn-sm btn-light fw-semibold fs-13px m-0 w-100 text-start btn-submit">
                                                                    <i class="fa-regular fa-trash me-2"></i> Hapus 
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <form action="{{ url('foto/komentar/' . $foto->id) }}" class="w-100 gap-2 p-3 border-top" method="POST">
                            @csrf
                            <div class="d-flex gap-2">
                                <div class="flex-grow-1">
                                    <input placeholder="Komentar" type="text" id="komentar" name="komentar" class="w-100 form-control form-control-lg rounded-pill fs-14px @error('komentar') is-invalid @enderror" value="{{ old('komentar') }}">
                                    @error('komentar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button class="btn btn-dark rounded-circle p-0 d-flex justify-content-center align-items-center btn-submit" style="height: 40px; width: 40px;">
                                    <i class="fa-regular fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        let swiper = new Swiper(".swiper", {
            speed: 500,
            // effect: "fade",
            navigation: {
                nextEl: '.button-next',
                prevEl: '.button-prev',
            },
            on: {
                slideChange: function() {
                    const index_currentSlide = this.realIndex;
                    const detailFoto = document.querySelector('.detail-foto-wrapper');

                    document.querySelectorAll('.detail-foto').forEach((element) => {
                        element.classList.add('d-none');
                    });
                    detailFoto.children[index_currentSlide].classList.remove('d-none')
                },
            },
        });

        const btnReFit = document.querySelectorAll('.btn-refit');
        btnReFit.forEach((element) => {
            console.log(btnReFit);
            element.addEventListener('click', () => {
                const img = element.parentElement.previousElementSibling;
                if (img.classList.contains('object-fit-cover')) {
                    img.classList.remove('object-fit-cover');
                    img.classList.add('object-fit-contain');
                    element.innerHTML = '<i class="fa-solid fa-maximize"></i>'
                } else {
                    img.classList.remove('object-fit-contain');
                    img.classList.add('object-fit-cover');
                    element.innerHTML = '<i class="fa-solid fa-minimize"></i>'
                }
            });
        });
    </script>
@endsection
