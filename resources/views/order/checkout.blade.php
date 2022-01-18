@extends('layouts.main')

@section('title', 'Checkout')

@section('content')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Product Checkout</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->


    <!--================Checkout Area =================-->
    <section class="checkout_area section-margin--small">
        <div class="container">
            @if (!Auth::check())
                <div class="returning_customer text-center mb-5">
                    <div class="check_title">
                        <h2>Returning Customer?</h2>
                    </div>
                    <p class="mb-3">If you have shopped with us before, please enter your details in the boxes
                        below. If you are a new
                        customer, please proceed to the Billing & Shipping section.</p>
                    <a href="{{ route('login') }}" class="button button-login">login</a>
                </div>
            @endif
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3><i class="fas fa-shipping-fast"></i> Shipping Details</h3>
                        <form class="row contact_form" action="{{ route('order.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="totalPrice" value="{{ $cart->totalPrice + 50 }}">

                            <input type="hidden" name="item_count" value="{{ count($cart->items) }}">

                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="first"
                                    name="name" placeholder="Name" @auth value="{{ Auth::user()->name }}" @endauth>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group p_star">
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    name="phone" placeholder="Phone number" @auth value="{{ Auth::user()->phone }}"
                                    @endauth>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" placeholder="Email Address" @auth value="{{ Auth::user()->email }}"
                                    @endauth>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group p_star">
                                <select class="country_select p-0 pl-2 form-control @error('country') is-invalid @enderror"
                                    name="country">
                                    <option value="">Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                    name="address" placeholder="Address" @auth value="{{ Auth::user()->address }}"
                                    @endauth>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                                    name="city" placeholder="Town/City">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('zip') is-invalid @enderror" id="zip"
                                    name="zip" placeholder="Postcode/ZIP">

                                @error('zip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group p_star">
                                <div class="row pl-2 pt-2">
                                    <div class="col-md-6 form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="cash"
                                            value="cash_on_delivery" checked>
                                        <label class="form-check-label" for="cash">
                                            Cash On Delivery
                                        </label>
                                    </div>
                                    <div class="col-md-6 accordionform-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="online"
                                            value="online">
                                        <label class="form-check-label" for="online">
                                            Online Payment
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group p_star text-center">
                                <button type="submit" class="button button-paypal"><i class="fa fa-wallet"></i>
                                    Proceed</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li>
                                    <a>
                                        <h4>Product <span>Total</span></h4>
                                    </a>
                                </li>
                                @foreach ($cart->items as $prodcut)
                                    <li>
                                        <a>
                                            {{ $prodcut['name'] }} <span class="middle">x
                                                {{ $prodcut['qty'] }}</span> <span
                                                class="last">${{ $prodcut['totalPrice'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="list list_2">
                                <li><a>Subtotal <span>${{ $cart->totalPrice }}</span></a></li>
                                <li><a>Shipping <span>$50.00</span></a></li>
                                <li><a>Total <span>${{ $cart->totalPrice + 50 }}</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
@endsection
