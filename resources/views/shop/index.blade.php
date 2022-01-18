@extends('layouts.main')

@section('title', 'Shop')

@section('content')
    <!-- ================ Shop section start ================= -->
    <section class="section-margin--small mb-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-5">
                    <div class="sidebar-categories">
                        <div class="head">Browse Categories</div>
                        <ul class="main-categories">
                            <li class="common-filter">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li class="filter-list">
                                            <input class="pixel-radio" type="radio" name="cats"
                                                value="{{ $category->id }}">
                                            <label for="{{ $category->name }}">{{ $category->name }}
                                                <span>({{ count($category->prodcuts) }})</span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="sidebar-filter">
                        <div class="top-filter-head">Product Filters</div>
                        <div class="common-filter">
                            <div class="head">Brands</div>
                            <ul>
                                @foreach ($brands as $brand)
                                    <li class="filter-list">
                                        <input class="pixel-radio" type="radio" name="brands"
                                            value="{{ $brand->id }}">
                                        <label for="{{ $brand->name }}">{{ $brand->name }}
                                            <span>({{ count($brand->prodcuts) }})</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-7">
                    <!-- Start Best Seller -->
                    <section class="lattest-product-area pb-40 category-list">
                        <div class="row" id="prodcut">
                            @foreach ($prodcuts as $prodcut)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card text-center card-product">
                                        <div class="card-product__img">
                                            <img class="card-img" src="{{ $prodcut->image }}"
                                                alt="{{ $prodcut->id }}">
                                            <ul class="card-product__imgOverlay">
                                                <li>
                                                    <button onclick="cart({{ $prodcut->id }})">
                                                        <i class="ti-shopping-cart"></i>
                                                    </button>
                                                </li>
                                                @if (Auth::check())
                                                    <li>
                                                        <button onclick="wishlist({{ $prodcut->id }})">
                                                            <i class="ti-heart"></i>
                                                        </button>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <p>{{ $prodcut->category->name }}</p>
                                            <h4 class="card-product__title"><a
                                                    href="{{ route('shop.show', $prodcut->id) }}">{{ $prodcut->name }}</a>
                                            </h4>
                                            <p class="card-product__price">${{ $prodcut->price }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <nav class="blog-pagination justify-content-center d-flex mb-5"
                                style="padding-left: 10rem!important;">
                                <ul class="pagination">
                                    {{ $prodcuts->links() }}
                                </ul>
                            </nav>
                        </div>
                    </section>
                    <!-- End Best Seller -->
                </div>
            </div>
        </div>
    </section>
    <!-- ================ Shop section end ================= -->

    <!-- ================ top product area start ================= -->
    <section class="related-product-area">
        <div class="container">
            <div class="section-intro pb-60px">
                <p>Popular Item in the market</p>
                <h2>Top <span class="section-intro__style">Product</span></h2>
            </div>
            <div class="row mt-30">
                @foreach ($topProdcuts->chunk(4) as $chunk)
                    <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
                        <div class="single-search-product-wrapper">
                            @foreach ($chunk as $prodcut)
                                <div class="single-search-product d-flex">
                                    <a href="{{ route('shop.show', $prodcut->id) }}"><img src="{{ $prodcut->image }}"
                                            alt="{{ $prodcut->id }}"></a>
                                    <div class="desc">
                                        <a href="{{ route('shop.show', $prodcut->id) }}"
                                            class="title">{{ $prodcut->name }}</a>
                                        <div class="price">${{ $prodcut->price }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ================ top product area end ================= -->

    <!-- ================ Subscribe section start ================= -->
    <section class="subscribe-position">
        <div class="container">
            <div class="subscribe text-center">
                <h3 class="subscribe__title">Get Update From Anywhere</h3>
                <p>Bearing Void gathering light light his eavening unto dont afraid</p>
                <div id="mc_embed_signup">
                    <form target="_blank"
                        action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                        method="get" class="subscribe-form form-inline mt-5 pt-1">
                        <div class="form-group ml-sm-auto">
                            <input class="form-control mb-1" type="email" name="EMAIL" placeholder="Enter your email"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '">
                            <div class="info"></div>
                        </div>
                        <button class="button button-subscribe mr-auto mb-1" type="submit">Subscribe Now</button>
                        <div style="position: absolute; left: -5000px;">
                            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>
    <!-- ================ Subscribe section end ================= -->
@endsection

@section('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*========== Category ==========*/

            var categories = [];

            $('input[name="cats"]').change(function(e) {
                e.preventDefault();
                categories = [];

                $('input[name="cats"]:checked').each(function() {
                    categories.push($(this).val());
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('shop.filter') }}",
                    data: {
                        category_id: categories,
                    },
                    success: function(response) {
                        if (response.err) {
                            toastr["error"](response.err);
                            toastr.options = {
                                "timeOut": "1000",
                            }
                        }
                        $("#prodcut").empty();
                        $("#prodcut").append(response.html);
                    }
                });
            });

            /*========== Brand ==========*/

            var brands = [];

            $('input[name="brands"]').change(function(e) {
                e.preventDefault();
                brands = [];

                $('input[name="brands"]:checked').each(function() {
                    brands.push($(this).val());
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('shop.filter') }}",
                    data: {
                        brand_id: brands,
                    },
                    success: function(response) {
                        if (response.err) {
                            toastr["error"](response.err);
                            toastr.options = {
                                "timeOut": "1000",
                            }
                        }
                        $("#prodcut").empty();
                        $("#prodcut").append(response.html);
                    }
                });
            });
        });

        /*========== Cart ==========*/

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

        /*========== Wishlist ==========*/

        function wishlist(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('wishlist.store') }}",
                data: {
                    prodcut_id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.err) {
                        toastr["error"](response.err);
                        toastr.options = {
                            "timeOut": "1000",
                        }
                    } else {
                        $("#wishlist-count").text(response.count);
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
