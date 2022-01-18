@extends('layouts.main')

@section('title', 'Verify Email')

@section('content')

    <!--================Verify Box Area =================-->
    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login_form_inner" id="verify">
                        <h3>{{ __('messages.Verify Email') }}</h3>
                        @if (session('resent'))
                            <div class="alert alert-success m-5" role="alert">
                                {{ __('messages.A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <p>{{ __('messages.Before proceeding, please check your email for a verification link.If you did not receive the email') }}
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('messages.click here to request another') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Verify Box Area =================-->

@endsection
