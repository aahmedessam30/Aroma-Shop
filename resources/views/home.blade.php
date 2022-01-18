@extends('layouts.main')

@section('content')
    <main class="site-main">
        <!--================ Hero banner start =================-->
        <section class="hero-banner">
            <div class="container">
                <div class="row no-gutters align-items-center pt-60px">
                    <div class="col-5 d-none d-sm-block">
                        <div class="hero-banner__img">
                            <img class="img-fluid" src="{{ asset('img/home/hero-banner.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
                        <div class="hero-banner__content">
                            <h4>Shop is fun</h4>
                            <h1>Browse Our Premium Product</h1>
                            <p>Us which over of signs divide dominion deep fill bring they're meat beho upon own earth
                                without morning over third. Their male dry. They are great appear whose land fly grass.
                            </p>
                            <a class="button button-hero" href="{{ route('shop.index') }}">Browse Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ Hero banner start =================-->

        <!--================ Hero Carousel start =================-->
        <section class="section-margin mt-0">
            <div class="owl-carousel owl-theme hero-carousel">
                @foreach ($prodcuts as $prodcut)
                    <div class="hero-carousel__slide">
                        <img src="{{ asset($prodcut->image) }}" alt="{{ $prodcut->id }}" class="img-fluid">
                        <a href="{{ route('shop.show', $prodcut->id) }}" class="hero-carousel__slideOverlay">
                            <h3>{{ $prodcut->name }}</h3>
                            <p>{{ $prodcut->category->name }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        <!--================ Hero Carousel end =================-->

        <!-- ================ trending product section start ================= -->
        <section class="section-margin calc-60px">
            <div class="container">
                <div class="section-intro pb-60px">
                    <p>Popular Item in the market</p>
                    <h2>Trending <span class="section-intro__style">Product</span></h2>
                </div>
                <div class="row">
                    @foreach ($prodcuts as $prodcut)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="card text-center card-product">
                                <div class="card-product__img">
                                    <img class="card-img" src="{{ asset($prodcut->image) }}"
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
                </div>
            </div>
        </section>
        <!-- ================ trending product section end ================= -->


        <!-- ================ offer section start ================= -->
        <section class="offer" id="parallax-1" data-anchor-target="#parallax-1"
            data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5">
                        <div class="offer__content text-center">
                            <h3>Up To 50% Off</h3>
                            <h4>Winter Sale</h4>
                            <p>Him she'd let them sixth saw light</p>
                            <a class="button button--active mt-3 mt-xl-4" href="{{ route('shop.index') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ================ offer section end ================= -->

        <!-- ================ Best Selling item  carousel ================= -->
        <section class="section-margin calc-60px">
            <div class="container">
                <div class="section-intro pb-60px">
                    <p>Popular Item in the market</p>
                    <h2>Best <span class="section-intro__style">Sellers</span></h2>
                </div>
                <div class="owl-carousel owl-theme" id="bestSellerCarousel">
                    @foreach ($topProdcuts as $prodcut)
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="img-fluid" src="{{ asset($prodcut->image) }}"
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
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ================ Best Selling item  carousel end ================= -->

        <!-- ================ Blog section start ================= -->
        <section class="blog">
            <div class="container">
                <div class="section-intro pb-60px">
                    <p>Popular Item in the market</p>
                    <h2>Latest <span class="section-intro__style">News</span></h2>
                </div>

                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                            <div class="card card-blog">
                                <div class="card-blog__img">
                                    <img class="card-img rounded-0" src="{{ $post->image }}" alt="{{ $post->id }}">
                                </div>
                                <div class="card-body">
                                    <ul class="card-blog__info">
                                        <li><a href="#">By {{ $post->user->name }}</a></li>
                                        <li><a href="#"><i class="ti-comments-smiley"></i> 2
                                                {{ $post->comments->count() }}</a></li>
                                    </ul>
                                    <h4 class="card-blog__title"><a
                                            href="{{ route('blog.show', $post->id) }}">{{ $post->title }}</a></h4>
                                    <p>{{ $post->content }}</p>
                                    <a class="card-blog__link" href="{{ route('blog.show', $post->id) }}">Read More <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ================ Blog section end ================= -->

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
    </main>
@endsection

@section('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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
