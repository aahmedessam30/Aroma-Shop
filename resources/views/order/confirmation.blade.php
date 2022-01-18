@extends('layouts.main')

@section('title', 'Confirmation')

@section('content')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Order Confirmation</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->

    <!--================Order Details Area =================-->
    <section class="order_details section-margin--small">
        <div class="container">
            <p class="text-center billing-alert">Thank you. Your order has been received.</p>
            <div class="row mb-5">
                <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                    <div class="confirmation-card">
                        <h3 class="billing-title">Order Info</h3>
                        <table class="order-rable">
                            <tr>
                                <td>Order number</td>
                                <td>: {{ $order->id }}</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>: {{ $order->created_at->diffForHumans() }}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>: USD {{ $order->totalPrice }}</td>
                            </tr>
                            <tr>
                                <td>Is Paid</td>
                                <td>: {{ $order->is_paid }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                    <div class="confirmation-card">
                        <h3 class="billing-title">Billing Address</h3>
                        <table class="order-rable">
                            <tr>
                                <td>Street</td>
                                <td>: {{ $address->address }}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>: {{ $address->city }}</td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>: {{ $address->country }}</td>
                            </tr>
                            <tr>
                                <td>Postcode</td>
                                <td>: {{ $address->zip }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                    <div class="confirmation-card">
                        <h3 class="billing-title">Shipping Address</h3>
                        <table class="order-rable">
                            <tr>
                                <td>Street</td>
                                <td>: {{ $address->address }}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>: {{ $address->city }}</td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>: {{ $address->country }}</td>
                            </tr>
                            <tr>
                                <td>Postcode</td>
                                <td>: {{ $address->zip }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="order_details_table">
                <h2>Order Details</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($cart)
                                @foreach ($cart->items as $prodcut)
                                    <tr>
                                        <td>
                                            <p>{{ $prodcut['name'] }}</p>
                                        </td>
                                        <td>
                                            <h5>x {{ $prodcut['qty'] }}</h5>
                                        </td>
                                        <td>
                                            <p>${{ $prodcut['price'] }}</p>
                                        </td>
                                    <tr>
                                @endforeach
                                <td>
                                    <h4>Subtotal</h4>
                                </td>
                                <td>
                                    <h5></h5>
                                </td>
                                <td>
                                    <p>${{ $cart->totalPrice }}</p>
                                </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4>Shipping</h4>
                                    </td>
                                    <td>
                                        <h5></h5>
                                    </td>
                                    <td>
                                        <p>$50.00</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4>Total</h4>
                                    </td>
                                    <td>
                                        <h5></h5>
                                    </td>
                                    <td>
                                        <h4>${{ $cart->totalPrice + 50 }}</h4>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Order Details Area =================-->
@endsection
