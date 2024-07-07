<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/images') }}/icon.png" type="image/x-icon">
    <title>@yield('title')</title>

    {{-- jquery --}}
    <script src="{{ asset('assets/js') }}/jquery.min.js"></script>

    {{-- bootstrap --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap') }}/css/bootstrap.min.css">
    <script src="{{ asset('assets/bootstrap') }}/js/bootstrap.bundle.min.js"></script>

    {{-- font awesome --}}
    <link rel="stylesheet" href="{{ asset('assets/font-awesome') }}/css/fontawesome.css">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome') }}/css/solid.css">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome') }}/css/light.css">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome') }}/css/regular.css">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome') }}/css/duotone.css">

    {{-- swiper js --}}
    <link rel="stylesheet" href="{{ asset('assets/swiper-js') }}/swiper-bundle.min.css">
    <script src="{{ asset('assets/swiper-js') }}/swiper-bundle.min.js"></script>

    {{-- moment js --}}
    <script src="{{ asset('assets/daterangepicker') }}/moment.min.js"></script>

    {{-- range date picker --}}
    <link rel="stylesheet" href="{{ asset('assets/daterangepicker') }}/daterangepicker.css">
    <script src="{{ asset('assets/daterangepicker') }}/daterangepicker.js"></script>
    <style>
        .daterangepicker {
            font-family: 'poppins';
        }
    </style>

    {{-- font --}}
    <link rel="stylesheet" href="{{ asset('assets/css') }}/font.css">

    {{-- navbar --}}
    <link rel="stylesheet" href="{{ asset('assets/css') }}/navbar.css">

    {{-- sidebar --}}
    <link rel="stylesheet" href="{{ asset('assets/css') }}/sidebar.css">

    {{-- custom style --}}
    <link rel="stylesheet" href="{{ asset('assets/css') }}/swiper.css">

    <link rel="stylesheet" href="{{ asset('assets/css') }}/scrollbar.css">

    <link rel="stylesheet" href="{{ asset('assets/css') }}/style.css">

    <link rel="stylesheet" href="{{ asset('assets/css') }}/post.css">

    @yield('css')

    <style>
        .pagination {
            --bs-pagination-color: black;
        }
        .modal {
            backdrop-filter: blur(5px);
        }
    </style>
</head>

<body style="font-family: poppins">

    @include('components.navbar')

    <main style="margin-top: 68px">
        @if (Session::has('pesan'))
            <div class="p-2 text-center w-100 fs-13px bg-{{ Session::get('type') == 'success' ? 'dark' : Session::get('type') }} text-white fw-semibold">{{ Session::get('pesan') }}</div>
        @endif
        @yield('section')
    </main>

    {{-- form submit --}}
    <script src="{{ asset('assets/js') }}/form-submit.js"></script>
    <script src="{{ asset('assets/js/masonry.pkgd.min.js') }}"></script>

    <script>   
        function imageLoaded() {
            $('[data-masonry]').masonry();
        }
    </script>
</body>

</html>
