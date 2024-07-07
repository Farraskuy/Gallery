@extends('pages.layout')

@section('title', 'Home | Gallery')
@section('section')
    <div class="container">
        <section class="mt-2 mb-4">
            <div class="swiper rounded-4 intro" style="height: 100px">
                <div class="swiper-wrapper">
                    <div class="swiper-slide bg-light">
                        <h1 class="fw-semibold m-0">Selamat datang di, <span class="fw-bolder">Gallery</span></h1>
                    </div>
                    <div class="swiper-slide bg-light">
                        <h1 class="fw-semibold m-0">Bagikan Pengalaman mu</h1>
                    </div>
                    <div class="swiper-slide bg-light">
                        <h1 class="fw-semibold m-0">Bagikan Karya mu</h1>
                    </div>
                    <div class="swiper-slide bg-light">
                        <h1 class="fw-semibold m-0">Bagikan Momen mu</h1>
                    </div>
                    <div class="swiper-slide bg-light">
                        <h1 class="fw-semibold m-0">Disini, di <span class="fw-bolder">Gallery</span> </h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="w-100 mb-4">
            <h5 class="text-jelajahi mb-4">Album Terbaru</h5>
            <div class="position-relative" style="height: fit-content">
                <div class="swiper album" style="height: fit-content">
                    <div class="swiper-wrapper" style="height: fit-content">
                        @foreach ($album as $post)
                            <div class="swiper-slide" style="height: fit-content">
                                <div class="post-container" style="height: fit-content">
                                    <a href="{{ url('album/' . $post->id) }}" class="post rounded mb-2 text-decoration-none active" style="height: 200px; width: 300px">
                                        <img class="w-100 h-100 object-fit-cover rounded" src="{{ asset('storage/upload/' . $post->foto[0]->lokasi_file) }}" alt="">
                                        <div class="post-content rounded">
                                            <div class="post-action-wrapper">
                                                <p class="wrap-text w-100 fw-semibold fs-15px my-2 text-white">{{ $post->nama_album }}</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="post-footer d-flex justify-content-between align-items-center gap-2">
                                        <a href="{{ url($post->user->username) }}" class="d-flex gap-2 text-decoration-none text-dark">
                                            <img src="{{ asset('storage/profil/' . $post->user->profil) }}" class="rounded-circle object-fit-cover" style="height: 30px; width: 30px">
                                            <p class="m-0 wrap-text fw-semibold my-1 fs-13px">{{ $post->user->nama_lengkap }}</p>
                                        </a>
                                        <div class="d-flex align-items-center gap-2 text-secondary fs-13px text-nowrap ms-auto">
                                            <p class="m-0 fw-semibold"><i class="fa-solid fa-image"></i> {{ convertNumberToShortFormat($post->foto->count()) }}</p>
                                            <p class="m-0 fw-semibold"><i class="fa-solid fa-heart"></i> {{ convertNumberToShortFormat($post->foto->sum('like_count')) }}</p>
                                            <p class="m-0 fw-semibold"><i class="fa-solid fa-comment"></i> {{ convertNumberToShortFormat($post->foto->sum('komentar_count')) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($loop->last)
                                <div class="swiper-slide">
                                    <a href="{{ url('album') }}" class=" text-decoration-none post-container border h-100 rounded">
                                        <div class=" d-flex align-items-center justify-content-center flex-column" style="height: 200px; width: 300px">
                                            <p class="text-dark fw-semibold m-0">
                                                lihat selengkapnya
                                            </p>
                                            <p class="btn btn-dark rounded-circle"><i class="fa-solid fa-arrow-right"></i></p>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <button class="btn btn-outline-dark btn-pagination sebelum" style="z-index: 1"><i class="fa-solid fa-arrow-left"></i></button>
                <button class="btn btn-outline-dark btn-pagination sesudah" style="z-index: 1"><i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </section>

        <section class="mb-4">
            <h5 class="text-jelajahi mb-4">Foto Terbaru</h5>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5" data-masonry='{"percentPosition": true }'>
                @foreach ($fotos as $foto)
                    <div class="post-container mb-2" style="height: fit-content">
                        <a href="{{ url('foto/' . $foto->id) }}" class="post rounded mb-2 text-decoration-none">
                            <img class="w-100 h-100 object-fit-cover rounded" src="{{ asset('storage/upload/' . $foto->lokasi_file) }}" alt="" onload="imageLoaded()">
                            <div class="post-content rounded">
                                <div class="post-action-wrapper">
                                    <p class="wrap-text w-100 fw-semibold fs-15px my-2 text-white">{{ $foto->judul_foto }}</p>
                                </div>
                            </div>
                        </a>
                        <div class="post-footer d-flex justify-content-between align-items-center gap-2">
                            <a href="{{ url($foto->album->user->username) }}" class="d-flex gap-2 text-decoration-none text-dark">
                                <img src="{{ asset('storage/profil/' . $foto->album->user->profil) }}" class="rounded-circle object-fit-cover" height="30" width="30">
                                <p class="m-0 wrap-text fw-semibold my-1 fs-13px">{{ $foto->album->user->nama_lengkap }}</p>
                            </a>
                            <div class="d-flex align-items-center gap-2 text-secondary fs-13px text-nowrap ms-auto">
                                <p class="m-0 fw-semibold"><i class="fa-solid fa-heart"></i> {{ convertNumberToShortFormat($foto->like_count) }}</p>
                                <p class="m-0 fw-semibold"><i class="fa-solid fa-comment"></i> {{ convertNumberToShortFormat($foto->komentar_count) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>
        <div class="text-end pe-4 d-flex justify-content-end">
            {{ $fotos->onEachSide(5)->links('pagination::bootstrap-5') }}
        </div>

        @if (Auth::user())
            <a href="{{ url('post-creation') }}" class="popup-buat-postingan position-fixed shadow">
                <i class="fa-solid fa-plus"></i>
            </a>
        @endif
    </div>

    <script>
        var swiper = new Swiper(".intro", {
            loop: true,
            speed: 1000,
            // effect: "fade",
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            }
        });

        var swiperAlbum = new Swiper(".album", {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: ".btn-pagination.sesudah",
                prevEl: ".btn-pagination.sebelum",
            },
            breakpoints: {
                '1500': {
                    slidesPerView: 4,
                    spaceBetween: 10,
                },
                '1200': {
                    slidesPerView: 3.5,
                    spaceBetween: 10,
                },
                '996': {
                    slidesPerView: 2.9,
                    spaceBetween: 10,
                },
                '850': {
                    slidesPerView: 2.2,
                    spaceBetween: 10,
                },
                '550': {
                    slidesPerView: 1.7,
                    spaceBetween: 10,
                },
            },
            spaceBetween: 30,
            freeMode: true,
        });
    </script>
@endsection
