<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Home')</title>
    <link rel="icon" href="{{ asset('img/Fevicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/linericon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/nice-select/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/toastr/toastr.min.css') }}">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">

</head>

<body>
    <!--================ Start Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand logo_h" href="{{ route('home') }}"><img
                            src="{{ asset('img/logo.png') }}" alt="Logo"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                            <li class="nav-item {{ Route::is('home') ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ route('home') }}">{{ __('messages.Home') }}</a>
                            </li>

                            <li class="nav-item {{ Route::is('shop.index') ? 'active' : '' }}"><a
                                    class="nav-link"
                                    href="{{ route('shop.index') }}">{{ __('messages.Shop') }}</a>
                            </li>

                            <li class="nav-item {{ Route::is('blog.index') ? 'active' : '' }}"><a
                                    class="nav-link"
                                    href="{{ route('blog.index') }}">{{ __('messages.Blog') }}</a>
                            </li>

                            <li class="nav-item {{ Route::is('contact') ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ route('contact') }}">{{ __('messages.Contact') }}</a>
                            </li>

                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" rel="alternate"
                                        hreflang="{{ $localeCode }}"
                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <ul class="nav-shop">
                            <li class="nav-item">
                                <button>
                                    <i class="ti-search"></i>
                                </button>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cart.index') }}">
                                    <button>
                                        <i class="ti-shopping-cart"></i>
                                        @if (session()->has('cart'))
                                            <span class="nav-shop__circle"
                                                id="cart-count">{{ session()->get('cart')->totalQty }}</span>
                                        @else
                                            <span class="nav-shop__circle" id="cart-count">0</span>
                                        @endif
                                    </button>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('wishlist.index') }}">
                                    <button>
                                        <i class="ti-heart"></i>
                                        @auth
                                            @if (Auth::user()->wishlist()->count() > 0)
                                                <span class="nav-shop__circle"
                                                    id="wishlist-count">{{ Auth::user()->wishlist()->count() }}</span>
                                            @else
                                                <span class="nav-shop__circle" id="wishlist-count">0</span>
                                            @endif
                                        @endauth
                                    </button>
                                </a>
                            </li>
                        </ul>

                        <ul class="navbar-nav ms-auto">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link text-dark"
                                            href="{{ route('login') }}">{{ __('messages.Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link  text-dark"
                                            href="{{ route('register') }}">{{ __('messages.Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle  text-dark" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            {{ __('messages.Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================ End Header Menu Area =================-->

    <!--================ Start Content Area =================-->
    @yield('content')
    <!--================ End Content Area =================-->

    <!--================ Start footer Area  =================-->
    <footer class="footer">
        <div class="footer-area">
            <div class="container">
                <div class="row section_gap">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget tp_widgets">
                            <h4 class="footer_title large_title">Our Mission</h4>
                            <p>
                                So seed seed green that winged cattle in. Gathering thing made fly you're no
                                divided deep moved us lan Gathering thing us land years living.
                            </p>
                            <p>
                                So seed seed green that winged cattle in. Gathering thing made fly you're no divided
                                deep moved
                            </p>
                        </div>
                    </div>
                    <div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6">
                        <div class="single-footer-widget tp_widgets">
                            <h4 class="footer_title">Quick Links</h4>
                            <ul class="list">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="#">Shop</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Product</a></li>
                                <li><a href="#">Brand</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="single-footer-widget instafeed">
                            <h4 class="footer_title">Gallery</h4>
                            <ul class="list instafeed d-flex flex-wrap">
                                <li><img src="{{ asset('img/gallery/r1.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('img/gallery/r2.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('img/gallery/r3.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('img/gallery/r5.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('img/gallery/r7.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('img/gallery/r8.jpg') }}" alt=""></li>
                            </ul>
                        </div>
                    </div>
                    <div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget tp_widgets">
                            <h4 class="footer_title">Contact Us</h4>
                            <div class="ml-40">
                                <p class="sm-head">
                                    <span class="fa fa-location-arrow"></span>
                                    Head Office
                                </p>
                                <p>123, Main Street, Your City</p>

                                <p class="sm-head">
                                    <span class="fa fa-phone"></span>
                                    Phone Number
                                </p>
                                <p>
                                    +123 456 7890 <br>
                                    +123 456 7890
                                </p>

                                <p class="sm-head">
                                    <span class="fa fa-envelope"></span>
                                    Email
                                </p>
                                <p>
                                    free@infoexample.com <br>
                                    www.infoexample.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row d-flex">
                    <p class="col-lg-12 footer-text text-center">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="fa fa-heart"
                            aria-hidden="true"></i> by Ahmed Essam
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!--================ End footer Area  =================-->



    <script src="{{ asset('vendors/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendors/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('vendors/skrollr.min.js') }}"></script>
    <script src="{{ asset('vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('vendors/nice-select/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('vendors/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('vendors/mail-script.js') }}"></script>
    <script src="{{ asset('vendors/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')
</body>

</html>
