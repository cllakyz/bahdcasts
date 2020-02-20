@extends('layouts.app')

@section('header')
    <header class="header header-inverse h-fullscreen pb-80" data-parallax="{{ asset('assets/img/bg-man.jpg ') }}" data-overlay="8">
        <div class="container text-center">

            <div class="row h-full">
                <div class="col-12 col-lg-8 offset-lg-2 align-self-center">

                    <h1 class="display-4 hidden-sm-down">BAHDCASTS</h1>
                    <h1 class="hidden-md-up">THE BEST WEB DEVELOPMENT SCREENCASTS ON THE INTERNET</h1>
                    <br>
                    <p class="lead text-white fs-20 hidden-sm-down"><span class="fw-400">Bahdcasts</span> is an awesome web development learning<br>subscription based SaaS  application powered with Vuejs and <span class="mark-border">Laravel 5.5   </span>.</p>

                    <br><br><br>

                    <a class="btn btn-lg btn-round w-200 btn-primary mr-16" href="/series">View more</a>

                </div>

                <div class="col-12 align-self-end text-center">
                    <a class="scroll-down-1 scroll-down-inverse" href="#" data-scrollto="section-intro"><span></span></a>
                </div>

            </div>

        </div>
    </header>
@stop

@section('content')
    <section class="section" id="section-intro">
        <div class="container">
            <header class="section-header">
                <small>Headers</small>
                <h2>More Headers</h2>
                <hr>
                <p class="lead">TheSaaS includes several header examples which can be use just by copy and paste the code</p>
            </header>


            <div class="row gap-y">

                <div class="col-12 col-md-6 col-lg-4">
                    <a class="text-center" href="header-color.html">
                        <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-color.jpg" alt="..."></p>
                        <h6>Solid Color</h6>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <a class="text-center" href="header-gradient.html">
                        <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-gradient.jpg" alt="..."></p>
                        <h6>Gradient</h6>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <a class="text-center" href="header-particle.html">
                        <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-particle.jpg" alt="..."></p>
                        <h6>Particle</h6>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <a class="text-center" href="header-typing.html">
                        <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-typing.jpg" alt="..."></p>
                        <h6>Typing Text</h6>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <a class="text-center" href="header-image.html">
                        <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-image.jpg" alt="..."></p>
                        <h6>Background Image</h6>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <a class="text-center" href="header-video.html">
                        <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-video.jpg" alt="..."></p>
                        <h6>Background Video</h6>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <a class="text-center" href="header-parallax.html">
                        <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-parallax.jpg" alt="..."></p>
                        <h6>Parallax</h6>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <a class="text-center" href="header-slider.html">
                        <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-slider.jpg" alt="..."></p>
                        <h6>Slider</h6>
                    </a>
                </div>
            </div>
        </div>
    </section>
@stop