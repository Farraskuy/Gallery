@extends('pages.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pengaturan.css') }}">
@endsection

@section('section')
    <div class="container-fluid container-md">
        <div class="row justify-content-center">
            <div class="col col-md-6 col-lg-9">
                <div class="w-100 mb-3 d-flex align-items-end" style="height: 150px">
                    <div class="d-flex align-items-center justify-content-between gap-4 w-100">
                        <div class="d-flex align-items-center gap-4">
                            <img style="object-fit: cover;" class="rounded-circle" height="60" width="60" src="{{ asset('storage/profil/' . Auth::user()->profil) }}" alt="{{ Auth::user()->profil }}">
                            <div class="flex-grow-1">
                                <h5 class="wrap-text text-dark mb-0">{{ Auth::user()->nama_lengkap }} <span class="text-secondary fs-15px">/</span> @yield('sub_title')</h5>
                                <p class="wrap-text text-secondary fs-14px mb-0">Sesuaikan gallery akunmu disini</p>
                            </div>
                        </div>
                        <div class="border h-100 p-3 fs-13px rounded">Bergabung pada {{ dateFormatFromTimestamp('d F Y', strtotime(Auth::user()->created_at)) }}</div>
                    </div>
                </div>
                <div class="d-flex" style="height: 350px">
                    <aside class=" h-100" style="width: 200px">
                        <button onclick="location.href = '{{ url('setting/profil') }}'" class="btn btn-menu {{ url('setting/profil') == url()->current() || url('setting') == url()->current() ? 'fw-semibold' : '' }}">Profil</button>
                        <button onclick="location.href = '{{ url('setting/akun') }}'" class="btn btn-menu {{ url('setting/akun') == url()->current() ? 'fw-semibold' : '' }}">Akun</button>
                        <button onclick="location.href = '{{ url('setting/reset-password') }}'" class="btn btn-menu {{ url('setting/reset-password') == url()->current() ? 'fw-semibold' : '' }}">Reset Pasword</button>
                        <hr class="m-2">
                        <button onclick="location.href = '{{ url('setting/hapus-akun') }}'" class="btn fs-14px text-start text-danger rounded-0 w-100 border-0  {{ url('setting/hapus-akun') == url()->current() ? 'fw-semibold' : '' }}">Hapus Akun</button>
                    </aside>
                    <div class="col h-100 ">
                        @yield('setting_content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
