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

    <!-- Custom Style -->
    @yield('style')
</head>

<body class="sb-nav-fixed bg-light">
    <nav class="sb-topnav navbar navbar-expand navbar-white bg-white">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 text-primary fw-bold" href="#">{{ env('APP_NAME') }}</a>

        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 shadow-sm rounded-circle" id="sidebarToggle"
            href="#!">
            <i class="bi bi-grid"></i>
        </button>

        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </div>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('profile') ? 'bg-primary text-white rounded-pill' : '' }}"
                    id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person"></i>
                    <span class="ms-2 d-none d-md-inline-block">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="bi bi-gear"></i>
                            <span class="ms-2">Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item gap-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#logoutModal">
                            <i class="bi bi-box-arrow-right"></i>
                            <span class="ms-2">Log out</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion bg-white" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading text-muted">Navigation</div>

                        <a class="nav-link {{ Request::is('home') ? 'bg-primary text-white' : '' }}"
                            href="{{ url('/home') }}">
                            <i class="bi bi-house"></i>
                            <span class="ms-2">Home</span>
                        </a>

                        @if (Auth::user()->role == 'provinsi')
                            @include('layouts.nav-provinsi')
                        @endif

                        @if (Auth::user()->role == 'kota')
                            @include('layouts.nav-kota')
                        @endif

                        @if (Auth::user()->role == 'kecamatan')
                            @include('layouts.nav-kecamatan')
                        @endif

                        @if (Auth::user()->role == 'kelurahan')
                            @include('layouts.nav-kelurahan')
                        @endif

                        @if (in_array(Auth::user()->role, ['provinsi', 'kota', 'kecamatan']))
                            <div class="sb-sidenav-menu-heading text-muted">Manajemen User</div>
                            <x-nav-user-create />
                        @endif

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small text-muted">Logged in as:</div>
                    <span class="fw-semibold">
                        {{ Str::upper(Auth::user()->role) }}
                    </span>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main class="container-fluid p-lg-4 p-md-3 p-sm-2 p-1">
                @yield('content')
            </main>

            <footer class="py-4 bg-white mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-center small">
                        <div class="text-muted">
                            Powered by <strong class="text-primary">{{ env('APP_COPYRIGHT') }}</strong> &copy;
                            {{ date('Y') }}
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal Logout -->
    <x-modal-confirm id="logoutModal" text="Are you sure for logout from this application ?"
        url="{{ route('logout') }}" />

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    @include('sweetalert::alert')
    @yield('script')
</body>

</html>
