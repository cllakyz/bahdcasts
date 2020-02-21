<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/core.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/thesaas.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="mh-fullscreen bg-img center-vh p-20" style="background-image: url('{{ asset('assets/img/bg-girl.jpg') }}');">

<div class="card card-shadowed p-50 w-400 mb-0">
    <h5 class="text-uppercase text-center">Register</h5>
    <br><br>

    <form class="form-type-material" action="{{ route('register') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Full name" name="name">
        </div>

        <div class="form-group">
            <input type="email" class="form-control" placeholder="Email address" name="email">
        </div>

        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
        </div>

        <div class="form-group">
            <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input">
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">I agree to all <a class="text-primary" href="#">terms</a></span>
            </label>
        </div>
        <br>
        <button class="btn btn-bold btn-block btn-primary" type="submit">Register</button>
    </form>
    <hr class="w-30">
    <p class="text-center text-muted fs-13 mt-20">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
</div>
<!-- Scripts -->
<script src="{{ asset('assets/js/core.min.js') }}"></script>
<script src="{{ asset('assets/js/thesaas.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

</body>
</html>
