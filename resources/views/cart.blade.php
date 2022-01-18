@extends('layouts.main')

@section('title', 'Cart')

@section('content')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Shopping Cart</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->



    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col" class="text-center">Price</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-center">Total</th>
                                <th scope="col" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody id="clear">
                            @if ($cart)
                                @foreach ($cart->items as $prodcut)
                                    <tr class="{{ $prodcut['id'] }}">
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img width="60" height="60" src="{{ $prodcut['image'] }}" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <p>{{ $prodcut['name'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <h5>${{ $prodcut['price'] }}</h5>
                                        </td>
                                        <td class="text-center">
                                            <div class="product_count">
                                                <input type="text" name="qty" class="input-text cart{{ $prodcut['id'] }}"
                                                    onchange="update('{{ route('cart.update', $prodcut['id']) }}' , '{{ $prodcut['id'] }}')"
                                                    value="{{ $prodcut['qty'] }}">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <h5 class="total{{ $prodcut['id'] }}">${{ $prodcut['totalPrice'] }}</h5>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-danger"
                                                onclick="deleteCart('{{ route('cart.destroy', $prodcut['id']) }}')">
                                                <i class="fa fa-trash-alt"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="out_button_area">
                                    <td>
                                        <h5>Total</h5>
                                    </td>
                                    <td class="text-center">
                                        <h5 id="totalPrice">${{ $cart->totalPrice }}</h5>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        <div class="checkout_btn_inner">
                                            <a class="gray_btn" href="{{ route('shop.index') }}">Continue Shopping</a>
                                            <a class="primary-btn ml-2" href="{{ route('order.index') }}">Proceed to
                                                checkout</a>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="5">Cart is empty</td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr class="bottom_button">
                                <td colspan="5">
                                    <a class="btn btn-outline-secondary btn-block" id="clear-btn"
                                        href="{{ route('cart.clear') }}">
                                        <i class="fa fa-trash-alt"></i> Clear Cart
                                    </a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
@endsection

@section('scripts')
    @if (Session::has('error'))
        <script>
            toastr["error"]("{{ Session::get('error') }}");
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /************Clear************/

            $("#clear-btn").click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "Delete",
                    url: "{{ route('cart.clear') }}",
                    dataType: "json",
                    success: function(response) {
                        if (response.err) {
                            toastr["error"](response.err);
                            toastr.options = {
                                "timeOut": "1000",
                            }
                        } else {
                            $("#clear").empty();
                            $("tbody").html(`<tr><td colspan='5'>Cart is empty</td></tr>`);
                            $("#cart-count").text(response.count);


                        }
                    }
                });
            });
        });

        /************Update************/

        function update(url, id) {
            $.ajax({
                type: "PUT",
                url: url,
                data: {
                    qty: $(".cart" + id).val()
                },
                dataType: "json",
                success: function(response) {
                    $(".total" + id).text('$' + response.total);
                    $("#totalPrice").text('$' + response.totalprice);
                },
            });
        }

        /************Delete************/

        function deleteCart(url) {
            $.ajax({
                type: "Delete",
                url: url,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $("." + response.id).remove();
                    if (response.err) {
                        toastr["error"](response.err);
                        toastr.options = {
                            "timeOut": "1000",
                        }
                    } else {
                        if (response.count == 0) {
                            $("#clear").empty();
                            $("tbody").html(`<tr><td colspan='5'>Cart is empty</td></tr>`);
                        }
                        $("#cart-count").text(response.count);
                        toastr["success"](response.msg);
                        toastr.options = {
                            "timeOut": "1000",
                        }
                    }
                },
            });
        }
    </script>
@endsection
