@extends('auth.layout')

@section('title', 'Daftar | Gallery')
@section('auth_section')
    <div class="container-fluid p-0 min-vh-100">
        <div class="h-100 row g-0 register-container">
            <div class="col-12 col-sm-3 banner">
                <img style="opacity: 0.5" class="h-100 w-100 object-fit-cover" src="{{ asset('assets/images') }}/gray_line_drawings_of_organic_shapes_background.jpg" alt="gray_line_drawings_of_organic_shapes_background">
                <div class="position-absolute mask-text-logo p-4">
                    <h1 class="m-0 me-3 fw-bold fs-2"><a class="text-dark text-decoration-none" href="{{ url('/') }}">Gallery</a></h1>
                </div>
            </div>
            <div class="col-12 col-sm-9 d-flex justify-content-center justify-content-lg-start align-items-sm-center pt-4 ps-lg-5 form">
                <div class="col-10 col-md-9 col-xl-7 p-0 ps-lg-5">

                    <h3 class="fw-medium m-0">Daftar ke <span class="fw-bold">Gallery</span></h3>
                    <p>Bergabung dengan kami dan bagikan moment mu</p>

                    <hr class="mb-3">

                    <form method="POST">
                        @csrf
                        <div class="mb-3 d-flex gap-3">
                            <div>
                                <label for="nama_lengkap" class="form-label fw-semibold">Nama lengkap</label>
                                <input required autofocus type="text" id="nama_lengkap" name="nama_lengkap" class="fs-6 form-control rounded-pill @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap') }}">
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <label for="username" class="form-label fw-semibold">Username</label>
                                <input required type="text" id="username" name="username" class="fs-6 form-control rounded-pill  @error('username') is-invalid @enderror" value="{{ old('username') }}">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input required type="email" id="email" name="email" class="fs-6 form-control rounded-pill  @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input required type="password" id="password" name="password" class="fs-6 form-control rounded-pill  @error('password') is-invalid @enderror" value="{{ old('password') }}">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_repeat" class="form-label fw-semibold">Ulangi Password</label>
                            <input required type="password" id="password_repeat" name="password_repeat" class="fs-6 form-control rounded-pill @error('password_repeat') is-invalid @enderror" value="{{ old('password_repeat') }}">
                            @error('password_repeat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button class="btn btn-lg btn-dark rounded-pill fw-semibold fs-6 w-100 mb-3 btn-submit">Buat akun <i class="fa-duotone fa-spinner-third fa-spin" style="opacity: 0; width: 0"></i></button>
                        <p class="text-center text-secondary @if ($errors->any()) pb-5 @endif">Sudah punya akun? <a class="text-dark" href="{{ url('login') }}">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
