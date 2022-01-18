@extends('layouts.main')

@section('title', 'Cart')

@section('content')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>WishList</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">WishList</li>
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
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="clear">
                            @if (count($wishlists) > 0)
                                @foreach ($wishlists as $wishlist)
                                    <tr class="{{ $wishlist->id }}">
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img width="60" height="60"
                                                        src="{{ asset($wishlist->prodcut->image) }}"
                                                        alt="{{ $wishlist->prodcut->id }}">
                                                </div>
                                                <div class="media-body">
                                                    <p>{{ $wishlist->prodcut->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <h5>${{ $wishlist->prodcut->price }}</h5>
                                        </td>
                                        <td class="text-center">
                                            <button onclick="cart({{ $wishlist->prodcut->id }})"
                                                class="btn btn-success cart" href="{{ route('cart.store') }}">
                                                <i class="fa fa-cart-plus"></i> Add To Cart</button>
                                            <button class="btn btn-danger wishlist"
                                                onclick="deleteWishlist('{{ route('wishlist.destroy', $wishlist->id) }}')">
                                                <i class="fa fa-trash-alt"></i> Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="3">Wishlist is empty</td>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr class="bottom_button">
                                <td colspan="3">
                                    <button class="btn btn-outline-secondary btn-block" id="clear-btn">
                                        <i class="fa fa-trash-alt"></i> Clear
                                        Wishlist</button>
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
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /************ Clear ************/

            $("#clear-btn").click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "Delete",
                    url: "{{ route('wishlist.clear') }}",
                    dataType: "json",
                    success: function(response) {
                        if (response.err) {
                            toastr["error"](response.err);
                            toastr.options = {
                                "timeOut": "1000",
                            }
                        } else {
                            $("#clear").empty();
                            $("tbody").html(`<tr><td colspan='3'>Wishlist is empty</td></tr>`);
                            $("#wishlist-count").text(response.count);
                            toastr["success"](response.msg);
                            toastr.options = {
                                "timeOut": "1000",
                            }
                        }
                    },
                });
            });
        });

        /************ Delete ************/

        function deleteWishlist(url) {
            $.ajax({
                type: "Delete",
                url: url,
                dataType: "json",
                success: function(response) {
                    $("." + response.id).remove();
                    if (response.err) {
                        toastr["error"](response.err);
                        toastr.options = {
                            "timeOut": "1000",
                        }
                    } else {
                        if (response.count == 0) {
                            $("#clear").empty();
                            $("tbody").html(
                                `<tr><td colspan='5'>Wishlist is empty</td></tr>`);
                        }
                        $("#wishlist-count").text(response.count);
                        toastr["success"](response.msg);
                        toastr.options = {
                            "timeOut": "1000",
                        }
                    }
                },
            });
        }

        /************ Cart ************/

        function cart(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('cart.store') }}",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.err) {
                        toastr["error"](response.err);
                        toastr.options = {
                            "timeOut": "1000",
                        }
                    } else {
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
