@php
    $jelajahi = [url('jelajahi'), url('jelajahi/foto'), url('jelajahi/album')];
@endphp


<nav class="navbar navbar-expand-lg bg-white fixed-top">
    <div class="container-fluid d-flex flex-nowrap">
        <a class="d-none d-sm-block navbar-brand fw-bold fs-3" href="{{ url('/') }}">Gallery</a>
        <div class="collapse navbar-collapse flex-grow-0">
            <ul class="navbar-nav mb-2 mb-lg-0 px-2">
                <li class="nav-item d-flex align-items-center">
                    <button class="w-100 border-0 btn btn-sm px-3 rounded-pill fw-semibold mb-0 btn-navbar {{ url('/') == url()->current() ? 'active' : '' }}" onclick="window.location.href='{{ url('/') }}'">Beranda</button>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <button class="w-100 border-0 btn btn-sm px-3 rounded-pill fw-semibold mb-0 btn-navbar {{ collect($jelajahi)->contains(url()->current()) ? 'active' : '' }}" onclick="window.location.href='{{ url('jelajahi') }}'">Jelajahi</button>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <button class="w-100 border-0 btn btn-sm px-3 rounded-pill fw-semibold mb-0 btn-navbar {{ url('post-creation') == url()->current() ? 'active' : '' }}" onclick="window.location.href='{{ url('post-creation') }}'">Buat</button>
                </li>
            </ul>
        </div>
        <form class="d-flex flex-grow-1" role="search" action="{{ collect($jelajahi)->contains(url()->current()) ? url()->current() : url('jelajahi') }}">
            <div class="position-relative w-100 d-flex align-items-center">
                <i class="fa-regular fa-search position-absolute ps-3"></i>
                <input class="form-control me-2 search-bar fs-13px ps-5" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request()->get('search') }}">
            </div>
        </form>
        @if (Auth::user())
            <button class="border-0 dropdown-toggle text-dark p-0 d-flex d-sm-none bg-white align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <img style="object-fit: cover;" class="rounded-circle" height="35" width="35" src="{{ asset('storage/profil/' . Auth::user()->profil) }}" alt="{{ Auth::user()->profil }}">
            </button>
            <div class="ps-2 border-2 dropdown d-none d-sm-block" style="cursor: pointer">
                <a class="text-decoration-none dropdown-toggle text-dark bg-white border-0" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="true">
                    <img style="object-fit: cover;" class="rounded-circle" height="35" width="35" src="{{ asset('storage/profil/' . Auth::user()->profil) }}" alt="{{ Auth::user()->profil }}">
                </a>
                <div style="min-width: 300px;" class="dropdown-menu dropdown-menu-end p-3 dropdown-menu-profil rounded-4 shadow" data-bs-popper="static">
                    <a href="{{ url(Auth::user()->username) }}" class="mb-2 text-decoration-none d-flex align-items-center bg-light p-2 rounded-3 gap-3">
                        <img style="object-fit: cover;" class="rounded-circle" height="50" width="50" src="{{ asset('storage/profil/' . Auth::user()->profil) }}" alt="{{ Auth::user()->profil }}">
                        <div>
                            <p class="wrap-text text-dark fw-semibold fs-14px mb-0">{{ Auth::user()->email }}</p>
                            <p class="wrap-text text-secondary fw-semibold fs-13px mb-0">{{ Auth::user()->username }}</p>
                            <p class="wrap-text text-secondary fs-13px mb-0">{{ Auth::user()->nama_lengkap }}</p>
                        </div>
                    </a>
                    <button type="button" onclick="window.location.href='{{ url(Auth::user()->username) }}'" class="dropdown-item small btn btn-sm rounded">
                        <div class="row g-0 flex-nowrap align-items-center p-1 px-2">
                            <i class="fa-regular fa-user col-2"></i>
                            <p class="m-0 col">Profil</p>
                        </div>
                    </button>
                    <button type="button" onclick="window.location.href='{{ url('setting') }}'" class="dropdown-item small btn btn-sm rounded">
                        <div class="row g-0 flex-nowrap align-items-center p-1 px-2">
                            <i class="fa-regular fa-gear col-2"></i>
                            <p class="m-0 col">Setting</p>
                        </div>
                    </button>
                    <hr class="my-2 mb-2">
                    <form action="{{ url('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item small btn btn-sm rounded btn-logout">
                            <div class="row g-0 flex-nowrap align-items-center p-1 px-2">
                                <i class="fa-regular fa-right-from-bracket col-2"></i>
                                <p class="m-0 col">Logout</p>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="d-flex">
                <a class="border-0 btn btn-sm px-3 rounded-pill fw-semibold mb-0 btn-navbar" href="{{ url('login') }}">Masuk</a>
                <a class="border-0 btn btn-sm px-3 rounded-pill fw-semibold mb-0 btn-navbar btn-outline-dark" style="border: 1px solid black !important" href="{{ url('register') }}">Daftar</a>
            </div>
        @endif

    </div>
</nav>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header">
        <a class="offcanvas-title fw-bold fs-3 text-decoration-none text-dark" href="{{ url('/') }}">Gallery</a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-between">
        <ul class="navbar-nav mb-2 mb-lg-0 px-2">
            <li class="nav-item d-flex align-items-center">
                <button class="justify-content-start w-100 border-0 btn btn-sm px-3 rounded fw-semibold mb-0 btn-navbar {{ url('/') == url()->current() ? 'active' : '' }}" onclick="window.location.href='{{ url('/') }}'">Beranda</button>
            </li>
            <li class="nav-item d-flex align-items-center">
                <button class="justify-content-start w-100 border-0 btn btn-sm px-3 rounded fw-semibold mb-0 btn-navbar {{ url('jelajahi') == url()->current() ? 'active' : '' }}" onclick="window.location.href='{{ url('jelajahi') }}'">Jelajahi</button>
            </li>
            @if (Auth::user())
                <li class="nav-item d-flex align-items-center">
                    <button class="justify-content-start w-100 border-0 btn btn-sm px-3 rounded fw-semibold mb-0 btn-navbar {{ url('post-creation') == url()->current() ? 'active' : '' }}" onclick="window.location.href='{{ url('post-creation') }}'">Buat</button>
                </li>
            @endif
        </ul>
        @if (!Auth::user())
            <hr>
            <div class="d-flex w-100">
                <a class="flex-grow-1 border-0 btn btn-sm px-3 rounded-pill fw-semibold mb-0 btn-navbar" href="{{ url('login') }}">Masuk</a>
                <a class="flex-grow-1 border-0 btn btn-sm px-3 rounded-pill fw-semibold mb-0 btn-navbar btn-outline-dark" style="border: 1px solid black !important" href="{{ url('register') }}">Daftar</a>
            </div>
        @endif
        @if (Auth::user())
            <div>
                <a href="{{ url(Auth::user()->username) }}" class="mb-2 text-decoration-none d-flex align-items-center bg-light p-2 rounded-3 gap-3">
                    <img style="object-fit: cover;" class="rounded-circle" height="50" width="50" src="{{ asset('storage/profil/' . Auth::user()->profil) }}" alt="{{ Auth::user()->profil }}">
                    <div>
                        <p class="wrap-text text-dark fw-semibold fs-14px mb-0">{{ Auth::user()->email }}</p>
                        <p class="wrap-text text-secondary fw-semibold fs-13px mb-0">{{ Auth::user()->username }}</p>
                        <p class="wrap-text text-secondary fs-13px mb-0">{{ Auth::user()->nama_lengkap }}</p>
                    </div>
                </a>
                <div class="d-flex">
                    <button type="button" onclick="window.location.href='{{ url('setting') }}'" class="flex-grow-1 small btn btn-sm rounded">
                        <div class="row g-0 flex-nowrap align-items-center p-1 px-2">
                            <i class="fa-regular fa-gear col-2"></i>
                            <p class="m-0 col">Setting</p>
                        </div>
                    </button>
                    <hr class="my-2 mb-2">
                    <form class="flex-grow-1 " action="{{ url('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-100 h-100 d-flex flex-nowrap align-items-center  p-1 px-2 small btn btn-sm rounded btn-logout">
                            {{-- <div class="d-flex flex-nowrap align-items-center p-1 px-2"> --}}
                            <i class="fa-regular fa-right-from-bracket col-2"></i>
                            <p class="m-0 col">Logout</p>
                            {{-- </div> --}}
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
