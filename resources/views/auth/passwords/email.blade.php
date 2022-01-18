@extends('layouts.main')

@section('title', 'Forgot Password')

@section('content')

    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login_form_inner" id="verify">
                        <h3>{{ __('messages.Reset Password') }}</h3>
                        @if (session('status'))
                            <div class="alert alert-success m-5" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-3 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-7">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-4 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
