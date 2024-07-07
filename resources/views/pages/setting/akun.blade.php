@extends('pages.setting.layout')

@section('title', 'Pengaturan Akun | Gallery')

@section('sub_title', 'Akun')

@section('setting_content')
    <div class="px-3">
        <form method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label fs-14px fw-semibold">Username</label>
                <input type="text" id="username" name="username" class="px-3 fs-14px form-control form-control-lg rounded-pill  @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}">
                <div class="form-text fs-13px">URL Gallery mu : <span class="fw-semibold">{{ url($user->username) }}</span></div>
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fs-14px fw-semibold">Email</label>
                <input type="email" id="email" name="email" class="px-3 fs-14px form-control form-control-lg rounded-pill  @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="text-end">
                <button class="btn fs-14px btn-dark rounded-pill fw-semibold mb-3 btn-submit px-4 py-2">Simpan <i class="fa-duotone fa-spinner-third fa-spin" style="opacity: 0; width: 0"></i></button>
            </div>
        </form>
    </div>
@endsection
