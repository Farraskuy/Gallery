@extends('auth.layout')

@section('title', 'Masuk | Gallery')
@section('auth_section')
    <div class="container-fluid container-xxl p-0 vh-100">
        <div class="h-100 row g-0">
            <div class="col-12 col-sm-3 position-relative banner">
                <img style="filter: invert(1)" class="h-100 w-100 object-fit-cover" src="{{ asset('assets/images') }}/gray_line_drawings_of_organic_shapes_background.jpg" alt="gray_line_drawings_of_organic_shapes_background">
                <div class="position-absolute mask-text-logo p-4">
                    <h1 class="m-0 me-3 fw-bold fs-2"><a class="text-white text-decoration-none" href="{{ url('/') }}">Gallery</a></h1>
                </div>
            </div>
            <div class="col-12 col-sm-9 d-flex justify-content-center justify-content-lg-start align-items-sm-center pt-4 pt-sm-0 ps-lg-5 form">
                <div class="col-10 col-sm-8 col-md-7 col-lg-5 p-0 ps-lg-5">

                    <h3 class="fw-medium m-0">Masuk ke <span class="fw-bold">Gallery</span></h3>
                    <p>Masuk menggunakan username atau email</p>

                    <hr class="mb-5">

                    <form method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="credential" class="form-label fw-semibold">Username atau Email</label>
                            <input type="text" id="credential" name="credential" class="fs-6 form-control rounded-pill @error('credential') is-invalid @enderror" value="{{ old('credential') }}" required autofocus>
                            @error('credential')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" id="password" name="password" class="fs-6 form-control rounded-pill @error('password') is-invalid @enderror" value="{{ old('password') }}" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button class="btn btn-lg btn-dark rounded-pill fw-semibold fs-6 w-100 mb-3 btn-submit">Masuk <i class="fa-duotone fa-spinner-third fa-spin" style="opacity: 0; width: 0"></i></button>
                        <p class="text-center text-secondary">Belum punya akun? <a class="text-dark" href="{{ url('register') }}">Daftar</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
