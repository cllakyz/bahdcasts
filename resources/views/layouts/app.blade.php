<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta Tags -->
    {!! SEO::generate() !!}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/core.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/thesaas.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script type="text/javascript">
        const APP_URL = "{{ env('APP_URL') }}";
    </script>
    @yield('styles')
</head>
<body>
    <div id="app">
        <!-- Topbar -->
        <nav class="topbar topbar-inverse topbar-expand-md topbar-sticky">
            <div class="container">

                <div class="topbar-left">
                    <button class="topbar-toggler">&#9776;</button>
                    <a class="topbar-brand" href="{{ route('index') }}">
                        BAHDCASTS
                    </a>
                </div>

                <div class="topbar-right">
                    <ul class="topbar-nav nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li>
                        @auth
                            @admin
                                <li class="nav-item"><a class="nav-link" href="{{ route('series.index') }}">All Series</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('series.create') }}">Create Series</a></li>
                            @else
                            <li class="nav-item"><a href="{{ route('all-series') }}" class="nav-link">All Series</a></li>
                            @endadmin
                            <li class="nav-item"><a class="nav-link" href="{{ route('profile', auth()->user()->username) }}">Hey {{ auth()->user()->name }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
                        @else
                            <li class="nav-item"><a href="{{ route('all-series') }}" class="nav-link">All Series</a></li>
                            <li class="nav-item"><a class="nav-link" href="javascript:;" data-toggle="modal" data-target="#loginModal">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register')}}">Register</a></li>
                        @endauth
                    </ul>
                </div>

            </div>
        </nav>
        <!-- END Topbar -->

        <!-- Header -->
        @yield('header')
        <!-- END Header -->

        <!-- Main container -->
        <main class="main-content">
            @yield('content')
        </main>
        <!-- END Main container -->

        <vue-noty></vue-noty>
        @guest
            <vue-login></vue-login>
        @endguest
        <!-- Footer -->
        <footer class="site-footer">
            <div class="container">
                <div class="row gap-y justify-content-center">
                    <div class="col-12 col-lg-6">
                        <ul class="nav nav-primary nav-hero">
                            <li class="nav-item hidden-sm-down">
                                <a class="nav-link" href="{{ route('index') }}">Bahdcasts</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END Footer -->
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/core.min.js') }}"></script>
    <script src="{{ asset('assets/js/thesaas.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @yield('scripts')
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>
