@extends('layouts.main')

@section('title', 'Post Details')

@section('content')

    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="blog">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Our Blog</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->

    <!--================Blog Area =================-->
    <section class="blog_area single-post-area py-80px section-margin--small">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-12">
                            <div class="feature-img">
                                <img class="img-fluid" src="{{ asset($post->image) }}" alt="{{ $post->id }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="blog_info text-right">
                                <div class="post_tag">
                                    <a class="active" href="#">{{ $post->category->name }}</a>
                                </div>
                                <ul class="blog_meta list">
                                    <li>
                                        <a href="#">{{ $post->user->name }}
                                            <i class="lnr lnr-user"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">{{ $post->created_at }}
                                            <i class="lnr lnr-calendar-full"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">{{ $post->views }} Views
                                            <i class="lnr lnr-eye"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">{{ count($post->comments) }} Comments
                                            <i class="lnr lnr-bubble"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 blog_details">
                            <form action="{{ route('blog.update', $post->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="text" name="title" value="{{ $post->title }}" class="border-0 w-100">

                                <textarea rows="6" class="excert border-0 w-100"
                                    name="content">{{ $post->content }}</textarea>

                                <input type="file" name="image" id="image" class="inputfile"
                                    value="{{ $post->image }}">
                                <label for="image" class="align-items-center border button button-blog">
                                    <i class="fa fa-camera"></i> Photo
                                </label>

                                <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Update
                                    Post</button>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Popular Posts</h3>
                            @foreach ($popularPosts as $post)
                                <div class="media post_item">
                                    <img src="{{ asset($post->image) }}" alt="{{ $post->id }}" width="60"
                                        height="60">
                                    <div class="media-body">
                                        <a href="{{ route('blog.show', $post) }}">
                                            <h3>{{ $post->title }}</h3>
                                        </a>
                                        <p>{{ $post->created_at }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="br"></div>
                        </aside>
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Post Catgories</h4>
                            <ul class="list cat-list">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="#" class="d-flex justify-content-between">
                                            <p>{{ $category->name }}</p>
                                            <p>{{ count($category->posts) }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="br"></div>
                        </aside>
                        <aside class="single-sidebar-widget tag_cloud_widget">
                            <h4 class="widget_title">Tag Clouds</h4>
                            <ul class="list">
                                <li>
                                    <a href="#">{{ $post->category->name }}</a>
                                </li>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

    <!--================Instagram Area =================-->
    <section class="instagram_area">
        <div class="container box_1620">
            <div class="insta_btn">
                <a class="btn theme_btn" href="#">Follow us on instagram</a>
            </div>
            <div class="instagram_image row m0">
                <img src="{{ asset('img/instagram/ins-1.jpg') }}" alt="image">
                <img src="{{ asset('img/instagram/ins-2.jpg') }}" alt="image">
                <img src="{{ asset('img/instagram/ins-3.jpg') }}" alt="image">
                <img src="{{ asset('img/instagram/ins-4.jpg') }}" alt="image">
                <img src="{{ asset('img/instagram/ins-5.jpg') }}" alt="image">
                <img src="{{ asset('img/instagram/ins-6.jpg') }}" alt="image">
            </div>
        </div>
    </section>
    <!--================End Instagram Area =================-->

@endsection
