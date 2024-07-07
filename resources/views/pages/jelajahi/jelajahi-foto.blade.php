@extends('pages.layout')

@section('title', 'Jelajahi Foto | Gallery')
@section('section')
    <div class="container pb-4">
        <section class="mb-4 pt-4">
            <div class="mb-4 d-flex justify-content-between align-items-end">
                <h5 class="text-jelajahi m-0">Foto Terbaru</h5>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-lg-5" data-masonry='{"percentPosition": true }'>

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
    </div>

    @if (Auth::user())
        <a href="{{ url('post-creation') }}" class="popup-buat-postingan position-fixed shadow">
            <i class="fa-solid fa-plus"></i>
        </a>
    @endif

    <script>
        var swiperAlbum = new Swiper(".album", {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: ".btn-pagination.sesudah",
                prevEl: ".btn-pagination.sebelum",
            },
            breakpoints: {
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
