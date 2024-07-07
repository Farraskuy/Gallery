@extends('pages.setting.layout')

@section('title', 'Reset Password | Gallery')

@section('sub_title', 'Reset Password')

@section('setting_content')
    <div class="px-3">
        <form method="POST">
            @csrf
            <div class="mb-3">
                <label for="password" class="form-label fs-14px fw-semibold">Password Baru</label>
                <input type="password" id="password" name="password" class="px-3 fs-14px form-control form-control-lg rounded-pill  @error('password') is-invalid @enderror" value="{{ old('password') }}">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_repeat" class="form-label fs-14px fw-semibold">Ulangi Password Baru</label>
                <input type="password" id="password_repeat" name="password_repeat" class="px-3 fs-14px form-control form-control-lg rounded-pill @error('password_repeat') is-invalid @enderror" value="{{ old('password_repeat') }}">
                @error('password_repeat')
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
