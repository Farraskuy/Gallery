@extends('pages.profil.profil-layout')

@section('title', $user->nama_lengkap . ' Foto | Gallery')

@section('content')
<section>
    <div class="h-100 w-100 pb-5" style="min-height: 500px;">
        <div class="row row-cols-2 row-cols-sm-3 g-3">
            @forelse ($foto as $item)
                {{-- @dump($item) --}}
                <div class="post-container profil" style="height: fit-content">
                    <div onclick="window.location.href='{{ url('foto/' . $item->id) }}'" class="post mb-2">
                        <img class="w-100 h-100 object-fit-cover rounded" src="{{ asset('storage/upload/' . $item->lokasi_file) }}" alt="">
                        <div class="post-content rounded">
                            <div class="post-action-wrapper">
                                <p class="wrap-text w-100 fw-semibold fs-15px my-2 text-white">{{ $item->judul_foto }}</p>
                                {{-- <div class="d-flex gap-2" onclick="(event) => event.stopPropagation()">
                                            <button class="btn bg-white post-action ms-auto"><i class="fa-regular fa-heart"></i></button>
                                        </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="post-footer d-flex justify-content-between align-items-center gap-2">
                        <div class="d-flex align-items-center gap-2 text-secondary fs-13px text-nowrap ms-auto">
                            <p class="m-0 fw-semibold"><i class="fa-solid fa-heart"></i> {{ convertNumberToShortFormat($item->like_count) }}</p>
                            <p class="m-0 fw-semibold"><i class="fa-solid fa-comment"></i> {{ convertNumberToShortFormat($item->komentar_count) }}</p>
                        </div>
                    </div>
                </div>

            @empty
                @if (Auth::id() == $user->id)
                    <div class="col w-100">
                        <div class="p-3 text-center border rounded d-flex justify-content-center align-items-center flex-column" style="border-style: dashed !important; border-width: 2px !important; height: 250px">
                            <h5 class="fs-16px fw-semibold">Buat Postingan Pertamamu</h5>
                            <p class="fs-14px">Buat posting pertamamu dan dapatkan perhatian, like, dan komentar</p>
                            <button onclick="window.location.href = '{{ url('post-creation') }}'" class="btn btn-dark fw-semibold fs-13px rounded-pill">Buat Postingan Pertamamu</button>
                        </div>
                    </div>
                @else 
                    <div class="d-flex justify-content-center align-items-center flex-column w-100">
                        <img src="{{ asset('assets/images/empty-result.png') }}" alt="" style="width: 100%; width: 350px" class="object-fit-contain">
                        <p class="fw-semibold m-0" style="font-size: 20px">Belum ada postingan yang di unggah</p>
                        <!-- <p class="fs-15px">Hasil pencarianmu tentang <span class="fw-semibold">"{{ request()->get('search') }}"</span> tidak ada</p> -->
                    </div>
                @endif
            @endforelse
        </div>
    </div>
</section>
@endsection