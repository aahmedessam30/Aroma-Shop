@extends('layouts.main')

@section('title', 'Register')

@section('content')

    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>{{ __('messages.Register') }}</h1>
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
                    <div class="login_box_img register_box_area">
                        <div class="hover">
                            <h4>{{ __('messages.Already have an account?') }}</h4>
                            <p>{{ __('messages.There are advances being made in science and technology everyday, and a good example of this is the') }}
                            </p>
                            <a class="button button-account"
                                href="{{ route('login') }}">{{ __('messages.Login Now') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner register_form_inner">
                        <h3>{{ __('messages.Create an Account') }}</h3>
                        <form method="POST" action="{{ route('register') }}" class="row login_form" id="register_form">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    placeholder="{{ __('messages.Name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" placeholder="{{ __('messages.Username') }}" required
                                    autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    placeholder="{{ __('messages.Email') }}" required autocomplete="email" autofocus>

                                @error('email')
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
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="{{ __('messages.Confirm Password') }}" required
                                    autocomplete="new-password">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit"
                                    class="button button-register w-100">{{ __('messages.Register') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Login Box Area =================-->

@endsection
