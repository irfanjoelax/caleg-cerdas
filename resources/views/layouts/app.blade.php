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

<body class="sb-nav-fixed bg-light">
    <nav class="sb-topnav navbar navbar-expand navbar-white bg-white">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 text-primary fw-bold" href="#">{{ env('APP_NAME') }}</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </div>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('profile') ? 'bg-primary text-white rounded-pill' : '' }}"
                    id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                    <span class="ml-2 d-none d-md-inline-block">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="fa-solid fa-gear"></i>
                            <span class="ms-1">Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span class="ms-1">Log out</span>
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
                            <i class="fa-solid fa-house"></i>
                            <span class="ms-2">Home</span>
                        </a>

                        <a class="nav-link {{ Request::is('area*') ? 'bg-primary text-white' : '' }} collapsed"
                            href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                            aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon">
                                <i class="fa-solid fa-map-location-dot"></i>
                            </div>
                            Wilayah
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">

                            @if (in_array(Auth::user()->role, ['provinsi']))
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('regency.index') }}">
                                        Kota/Kabupaten
                                    </a>
                                </nav>
                            @endif

                            @if (in_array(Auth::user()->role, ['provinsi', 'kota']))
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('district.index') }}">
                                        Kecamatan
                                    </a>
                                </nav>
                            @endif

                            @if (in_array(Auth::user()->role, ['provinsi', 'kota', 'kecamatan']))
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('village.index') }}">
                                        Kelurahan
                                    </a>
                                </nav>
                            @endif

                            @if (in_array(Auth::user()->role, ['provinsi', 'kota', 'kecamatan', 'kelurahan']))
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('neighbourhood.index') }}">
                                        Rukun Tetangga
                                    </a>
                                </nav>
                            @endif

                        </div>

                        <a class="nav-link {{ Request::is('voting-place*') ? 'bg-primary text-white' : '' }}"
                            href="{{ route('voting-place.index') }}">
                            <i class="fa-solid fa-person-booth"></i>
                            <span class="ms-2">Daftar TPS</span>
                        </a>

                        <a class="nav-link {{ Request::is('relawan*') ? 'bg-primary text-white' : '' }}"
                            href="{{ route('relawan.index') }}">
                            <i class="fa-solid fa-people-arrows"></i>
                            <span class="ms-2">Relawan</span>
                        </a>

                        <a class="nav-link {{ Request::is('pendukung*') ? 'bg-primary text-white' : '' }}"
                            href="{{ route('pendukung.index') }}">
                            <i class="fa-solid fa-users-rays"></i>
                            <span class="ms-2">Pendukung</span>
                        </a>

                        @if (in_array(Auth::user()->role, ['provinsi', 'kota', 'kecamatan']))
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
    <script src="{{ asset('js/app.js') }}" defer></script>
    @include('sweetalert::alert')
    @yield('script')
</body>

</html>
