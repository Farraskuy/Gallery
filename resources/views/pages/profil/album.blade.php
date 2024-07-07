@extends('pages.profil.profil-layout')

@section('title', $user->nama_lengkap . ' Album | Gallery')

@section('content')
    <section>
        <div class="h-100 w-100 pb-5" style="min-height: 500px;">
            <div class="row row-cols-2 row-cols-sm-3 g-3">
                @forelse ($post as $item)
                    {{-- @dump($item) --}}
                    <div class="post-container profil" style="height: fit-content">
                        <div onclick="window.location.href='{{ url('album/' . $item->id) }}'" class="post active mb-2">
                            <img class="w-100 h-100 object-fit-cover rounded" src="{{ asset('storage/upload/' . $item->foto[0]->lokasi_file) }}" alt="">
                            <div class="post-content rounded">
                                <div class="post-action-wrapper">
                                    <p class="wrap-text w-100 fw-semibold fs-15px my-2 text-white">{{ $item->nama_album }}</p>
                                    <div class="d-flex gap-2" onclick="(event) => event.stopPropagation()">
                                        {{-- <button class="btn bg-white post-action ms-auto"><i class="fa-regular fa-heart"></i></button> --}}
                                        @if ($item->user_id == Auth::id())
                                            <div class="stop-propagation ps-2 border-2 dropdown" style="cursor: pointer" onclick="(event) => event.stopPropagation()">
                                                <button class="stop-propagation btn bg-white post-action ms-auto" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="true"><i class="fa-regular fa-ellipsis"></i></button>
                                                <div class="stop-propagation dropdown-menu dropdown-menu-end dropdown-menu-profil p-0 d-flex flex-column align-items-end" style="width: fit-content; background-color: transparent; top: -100px; z-index: 2;">
                                                    <button class="post-action stop-propagation btn btn-sm bg-white rounded-circle fw-semibold fs-13px mb-2" data-bs-toggle="modal" data-bs-target="#modal-hapus" data-bs-id="{{ $item->id }}">
                                                        <i class="fa-regular fa-trash"></i>
                                                    </button>
                                                    <a href="{{ url('post-creation/edit/' . $item->id) }}" class="post-action stop-propagation btn btn-sm bg-white rounded-circle fw-semibold fs-13px">
                                                        <i class="fa-regular fa-pen"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="post-footer d-flex justify-content-between align-items-center gap-2">
                            <div class="d-flex align-items-center gap-2 text-secondary fs-13px text-nowrap ms-auto">
                                <p class="m-0 fw-semibold"><i class="fa-solid fa-image"></i> {{ convertNumberToShortFormat($item->foto->count()) }}</p>
                                <p class="m-0 fw-semibold"><i class="fa-solid fa-heart"></i> {{ convertNumberToShortFormat($item->foto->sum('like_count')) }}</p>
                                <p class="m-0 fw-semibold"><i class="fa-solid fa-comment"></i> {{ convertNumberToShortFormat($item->foto->sum('komentar_count')) }}</p>
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
                        </div>
                    @endif
                @endforelse
            </div>
        </div>
    </section>

    <div class="modal fade" tabindex="-1" id="modal-hapus">
        <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
            <form method="POST" class="modal-content rounded-4" base-action="{{ url('album/delete') }}">
                @csrf
                @method('delete')
                <div class="p-5 d-flex align-items-center flex-column">

                    <i class="fa-regular fa-triangle-exclamation text-danger fs-1 mb-3"></i>
                    <h5 class="fw-semibold text-center">Apakah kamu yakin, ingin menghapus album ini?</h5>

                    <p class="fs-14px text-center">Harap diperhatikan, data yang sudah terhapus tidak dapat dikembalikan/dipulihkan kembali dengan cara apapun.</p>

                    <button class="w-100 btn btn-danger fs-14px border rounded-pill fw-semibold mb-3 px-4 py-2 btn-submit">Hapus Album <i class="fa-duotone fa-spinner-third fa-spin" style="opacity: 0; width: 0"></i></button>
                    <button type="button" data-bs-dismiss="modal" class="w-100 btn fs-14px border rounded-pill fw-semibold px-4 py-2">Batalkan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
