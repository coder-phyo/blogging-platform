<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <!-- CSS files -->
    <link href="{{ asset('author/dist/css/tabler.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('author/dist/css/tabler-flags.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('author/dist/css/tabler-payments.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('author/dist/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('author/dist/css/demo.min.css?1684106062') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('author/dist/libs/ijaboCropTool/ijaboCropTool.min.css') }}">
    @stack('stylesheets')
    @livewireStyles
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body>
    <script src="{{ asset('authordist/js/demo-theme.min.js?1684106062') }}"></script>
    <div class="page">
        <!-- Navbar -->
        <header class="navbar navbar-expand-md navbar-overlap d-print-none" data-bs-theme="dark">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="{{ route('author#home') }}">
                        <img src="{{ asset('user/images/logo.png') }}" width="110" height="32" alt="Tabler"
                            class="navbar-brand-image">
                    </a>
                </h1>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                            aria-label="Open user menu">
                            <span class="avatar avatar-sm"
                                style="background-image: url({{ Auth::user()->profile_picture != null ? asset('storage/authorImage/' . Auth::user()->profile_picture) : asset('defaultImage/default.jpg') }})"></span>
                            <div class="d-none d-xl-block ps-2">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="mt-1 small text-muted">
                                    {{ Auth::user()->role === 0 ? 'Admin/Super Author' : 'Author' }}</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="{{ route('author#profile') }}" class="dropdown-item">Profile</a>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                        <ul class="navbar-nav">
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('author#home') }}">
                                    <span class="nav-link-title">
                                        Home
                                    </span>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('author#categoryPage') }}">
                                    <span class="nav-link-title">
                                        Categories
                                    </span>
                                </a>
                            </li>
                            @if (Auth::user()->role === 0)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('author#authorsPage') }}">
                                        <span class="nav-link-title">
                                            Authors
                                        </span>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-title">
                                        Posts
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('author#addPost') }}">
                                        Add new
                                    </a>
                                    <a class="dropdown-item" href="{{ route('author#allPosts') }}">
                                        All Posts
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-title">
                                        Settings
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="./changelog.html">
                                        General Settings
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-wrapper">
            <!-- Page header -->
            @yield('pageHeader')
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    @yield('contents')
                </div>
            </div>
            <footer class="footer footer-transparent d-print-none  bottom-0">
                <div class="container-xl justify-content-center">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; 2023
                                    <a href="./home" class="link-secondary">Reporter</a>.
                                    All rights reserved.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('author/dist/libs/apexcharts/dist/apexcharts.min.js?1684106062') }}" defer></script>
    <script src="{{ asset('author/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062') }}" defer></script>
    <script src="{{ asset('author/dist/libs/jsvectormap/dist/maps/world.js?1684106062') }}" defer></script>
    <script src="{{ asset('author/dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('author/dist/libs/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
    <script src="{{ asset('author/dist/libs/ijaboViewer/jquery.ijaboViewer.min.js') }}"></script>
    <!-- Tabler Core -->
    <script src="{{ asset('author/dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('author/dist/js/demo.min.js') }}" defer></script>
    @stack('scripts')
    @livewireScripts
</body>

</html>
