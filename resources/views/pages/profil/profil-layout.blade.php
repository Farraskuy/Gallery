@extends('pages.layout')

@section('section')
    {{-- @dump($user) --}}
    <div class="container">
        <section class="profil mt-2 mb-3 pt-5 w-100 d-flex justify-content-center">
            <div class="d-flex align-items-center justify-content-center flex-wrap" style="max-width: 500px; min-width: 400px;">
                <div class="d-flex align-items-center w-100 flex-wrap mb-4 justify-content-center justify-content-md-center" style="min-height: 200px;">
                    <div class="d-flex justify-content-center col-12 col-md-3 col-lg-4 pe-lg-4">
                        <div style="height:120px; width:120px">
                            <img style="object-fit: cover; height:120px; width:120px" class="rounded-circle" src="{{ asset('storage/profil/' . $user->profil) }}" alt="{{ $user->profil }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 text-secondary fs-14px text-nowrap">
                            <p class="m-0 fw-semibold"><i class="fa-solid fa-images"></i> {{ convertNumberToShortFormat($user->album_count) }} Album</p>
                            <p class="m-0 fw-semibold"><i class="fa-solid fa-image"></i> {{ convertNumberToShortFormat($user->foto_count) }} Foto</p>
                        </div>
                        <h2 class="wrap-text text-dark fw-semibold text-center text-md-start">{{ $user->nama_lengkap }}</h2>
                        @if (Auth::id() == $user->id)
                            <button onclick="window.location.href='{{ url('setting/profil') }}'" class="btn btn-outline-dark fs-14px fw-semibold rounded-pill w-100">Edit Profil</button>
                        @else
                            <p class="wrap-text text-secondary fw-semibold fs-15px mb-0">{{ '@' . $user->username }}</p>
                        @endif
                    </div>
                </div>
                <div class="ps-2 position-relative w-100" style="max-height: 115px;">
                    <p class="m-0 fw-semibold">Bio</p>
                    <p class="m-0 overflow-y-auto h-100 w-100">
                        {{ $user->bio ? $user->bio : '-' }}
                    </p>
                </div>
            </div>
        </section>

        @if (Auth::user())
            <a href="{{ url('post-creation') }}" class="popup-buat-postingan position-fixed shadow">
                <i class="fa-solid fa-plus"></i>
            </a>
        @endif

        <div class="p-2 w-100 d-flex gap-2 mb-4 border-bottom overflow-x-auto">
            <a href="{{ url($user->username) }}" class="btn {{ url()->current() == url($user->username) ? 'btn-dark' : 'btn-light' }} rounded-pill fs-14px fw-semibold text-decoration-none p-3 py-2">Album</a>
            <a href="{{ url($user->username . '/foto') }}" class="btn {{ url()->current() == url($user->username . '/foto') ? 'btn-dark' : 'btn-light' }} rounded-pill fs-14px fw-semibold text-decoration-none p-3 py-2">Foto</a>
            @if (Auth::id() == $user->id)
                <a id="report" href="{{ url($user->username . '/report') }}" class="btn {{ url()->current() == url($user->username . '/report') ? 'btn-dark' : 'btn-light' }} rounded-pill fs-14px fw-semibold text-decoration-none p-3 py-2">Report</a>
            @endif
        </div>

        @yield('content')
    </div>


    <script>
        const btnStopPropagation = document.querySelectorAll('.stop-propagation');
        btnStopPropagation.forEach(element => {
            element.addEventListener('click', (event) => {
                event.stopPropagation();
            })
        });
        const modalHapus = document.getElementById('modal-hapus')
        if (modalHapus) {
            modalHapus.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const id = button.getAttribute('data-bs-id')

                const form = modalHapus.querySelector('.modal-content')
                form.setAttribute('action', form.getAttribute('base-action') + "/" + id);
            });
        }
    </script>
@endsection
