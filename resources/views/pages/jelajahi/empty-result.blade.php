@extends('pages.layout')

@section('title', 'Jelajahi | Gallery')
@section('section')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center flex-column">
            <img src="{{ asset('assets/images/empty-result.png') }}" alt="" style="width: 100%; width: 350px" class="object-fit-contain">
            <p class="fw-semibold m-0" style="font-size: 20px">Yah, Maaf</p>
            <p class="fs-15px">Hasil pencarianmu tentang <span class="fw-semibold">"{{ request()->get('search') }}"</span> tidak ada</p>
        </div>
    </div>
@endsection
