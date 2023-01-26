<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset(env('APP_LOGO')) }}" type="image/x-icon">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" />

    <!-- Custom Style -->
    @yield('style')
</head>

<body class="bg-light">
    {{-- Heading --}}
    <header class="navbar bg-white fixed-top py-2">
        <div class="container">
            <span class="navbar-brand align-items-center" href="#">
                @if (Request::is('home'))
                    <img src="{{ asset(env('APP_LOGO')) }}" alt="Logo" width="40"
                        class="d-inline-block align-text-middle">
                @else
                    <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('home') }}"
                        class="btn btn-light">
                        <i class="fa-solid fa-arrow-left-long"></i>
                    </a>
                @endif

                <span class="fw-bold ms-2">@yield('title')</span>
            </span>
        </div>
    </header>

    <div class="pt-5"></div>

    <main class="container mt-4">
        @yield('content')
    </main>

    <div class="py-5"></div>

    <nav class="fixed-bottom bg-white">
        <div class="container py-3">
            <div class="d-flex align-item-center justify-content-around">
                <a href="{{ route('home') }}"
                    class="text-decoration-none d-flex flex-column align-items-center {{ Request::is('home') ? 'text-primary fw-semibold' : 'text-muted' }}">
                    <i class="fa-solid fa-house"></i>
                    <small>Home</small>
                </a>
                <a href="{{ route('pendukung.index') }}"
                    class="text-decoration-none d-flex flex-column align-items-center {{ Request::is('pendukung*') ? 'text-primary fw-semibold' : 'text-muted' }}">
                    <i class="fa-solid fa-users-rays"></i>
                    <small>Pendukung</small>
                </a>
                <a href="{{ route('profile.index') }}"
                    class="text-decoration-none d-flex flex-column align-items-center {{ Request::is('profile') ? 'text-primary fw-semibold' : 'text-muted' }}">
                    <i class="fa-regular fa-circle-user"></i>
                    <small>Profile</small>
                </a>
            </div>
        </div>
    </nav>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @include('sweetalert::alert')
    @yield('script')
</body>

</html>
