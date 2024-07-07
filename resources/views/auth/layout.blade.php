<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/images') }}/icon.png" type="image/x-icon">
    <title>@yield('title')</title>

    {{-- bootstrap --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap') }}/css/bootstrap.min.css">
    <script src="{{ asset('assets/bootstrap') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js') }}/jquery.min.js"></script>

    {{-- font awesome --}}
    <link rel="stylesheet" href="{{ asset('assets/font-awesome') }}/css/fontawesome.css">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome') }}/css/solid.css">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome') }}/css/light.css">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome') }}/css/regular.css">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome') }}/css/duotone.css">

    {{-- font --}}
    <link rel="stylesheet" href="{{ asset('assets/css') }}/font.css">

    {{-- custom style --}}
    <link rel="stylesheet" href="{{ asset('assets/css') }}/login.css">

    {{-- scrollbar --}}
    <link rel="stylesheet" href="{{ asset('assets/css') }}/scrollbar.css">

</head>

<body style="font-family: poppins">

    @if (Session::has('pesan'))
        <div class="p-2 text-center w-100 fs-13px bg-{{ Session::get('type') == 'success' ? 'dark' : Session::get('type') }} text-white fw-semibold">{{ Session::get('pesan') }}</div>
    @endif
    
    @yield('auth_section')

    {{-- form submit --}}
    <script src="{{ asset('assets/js') }}/form-submit.js"></script>
</body>

</html>
