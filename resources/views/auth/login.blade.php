@extends('layouts.main')

@section('title', 'Login')

@section('content')

    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>{{ __('messages.Login') }}</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.Home') }}</a></li>
                            <li class="breadcrumb-item" aria-current="page">
                                {{ __('messages.Login') }}/{{ __('messages.Register') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->

    <!--================Login Box Area =================-->
    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>{{ __('messages.New to our website?') }}</h4>
                            <p>{{ __('messages.There are advances being made in science and technology everyday, and a good example of this is the') }}
                            </p>
                            <a class="button button-account"
                                href="{{ route('register') }}">{{ __('messages.Create an Account') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>{{ __('messages.Login to enter') }}</h3>
                        <form method="POST" action="{{ route('login') }}" class="row login_form" id="contactForm">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" placeholder="{{ __('messages.Username') }}"
                                    value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="{{ __('messages.Password') }}" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <input type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label for="f-option2">{{ __('messages.Keep me logged in') }}</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit"
                                    class="button button-login w-100">{{ __('messages.Login') }}</button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('messages.Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Login Box Area =================-->

@endsection
