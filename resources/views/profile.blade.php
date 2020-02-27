@extends('layouts.app')

@section('header')
    <header class="header header-inverse" style="background-color: #1ac28d">
        <div class="container text-center">
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">
                    <h1>{{ $user->name }}</h1>
                    <p class="fs-20 opacity-70">{{ $user->username }}</p>
                    <br>
                    <h1>{{ $user->getTotalNumberOfCompletedLessons() }}</h1>
                    <p class="fs-20 opacity-70">Lessons completed</p>
                </div>
            </div>

        </div>
    </header>
@stop

@section('content')
    <section class="section" id="section-vtab">
        <div class="container">
            <header class="section-header">
                <h2>Series being watched ...</h2>
                <hr>
            </header>

            <div class="row gap-5">
                @forelse($series as $s)
                    <div class="card mb-30">
                        <div class="row">
                            <div class="col-12 col-md-4 align-self-center">
                                <a href=""><img src="{{ $s->image_path }}" alt="{{ $s->title }}"></a>
                            </div>

                            <div class="col-12 col-md-8">
                                <div class="card-block">
                                    <h4 class="card-title">{{ $s->title }}</h4>

                                    <p class="card-text">{{ $s->description }}</p>
                                    <a class="fw-600 fs-12" href="{{ route('series', $s->slug) }}">Read more <i class="fa fa-chevron-right fs-9 pl-8"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
    @if(auth()->id() === $user->id)
        @php
            $subscription = $user->subscriptions->first();
        @endphp
        <section class="section bg-gray" id="section-vtab">
            <div class="container">
                <header class="section-header">
                    <h2>Edit Your Profile</h2>
                    <hr>
                </header>

                <div class="row gap-5">

                    <div class="col-12 col-md-4">
                        <ul class="nav nav-vertical">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home-2">
                                    <h6>Personal Details</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#messages-2">
                                    <h6>Payments & Subscriptions</h6>
                                </a>
                            </li>
                            @if($user->card_brand)
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#settings-2">
                                        <h6>Card details</h6>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>


                    <div class="col-12 col-md-8 align-self-center">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home-2">
                                <form action="{{ route('profile.update', $user->username)  }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input class="form-control form-control-lg" type="text" name="name" placeholder="Your name" value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-lg" type="text" name="email" placeholder="Your email" value="{{ $user->email }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-lg" placeholder="Password" name="password">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-lg" placeholder="Confirm Password" name="password_confirmation">
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Save changes</button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="messages-2">
                                <form action="{{ route('subscriptions.change') }}" method="post">
                                    {{ csrf_field() }}
                                    <h5 class="text-center">
                                        Your current plan:
                                        @if($subscription)
                                            <span class="badge badge-success">{{ $subscription->stripe_plan }}</span>
                                        @else
                                            <span class="badge badge-danger">NO PLAN</span>
                                        @endif
                                    </h5>
                                    <br>
                                    @if($subscription)
                                        <select name="plan" class="form-control">
                                            <option value="monthly"{{ $subscription->stripe_plan == "monthly" ? " selected" : NULL }}>Monthly</option>
                                            <option value="yearly"{{ $subscription->stripe_plan == "yearly" ? " selected" : NULL }}>Yearly</option>
                                        </select>
                                        <br>
                                        <p class="text-center">
                                            <button class="btn btn-primary" type="submit">Change plan</button>
                                        </p>
                                    @endif

                                </form>
                            </div>

                            @if($user->card_brand)
                                <div class="tab-pane fade" id="settings-2">
                                    <div class="row">
                                        <h2 class="text-center">
                                            Your current card: <span class="badge badge-sm badge-primary">{{ $user->card_brand }}:{{ $user->card_last_four }}</span>
                                        </h2>
                                        <p class="ml-5 mt-5 text-center">
                                            <vue-update-card email="{{ $user->email }}"></vue-update-card>
                                        </p>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>


                </div>


            </div>
        </section>
    @endif
@stop

@section('scripts')
    <script src="https://checkout.stripe.com/checkout.js"></script>
@endsection