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
                            <h2>{{ $post->title }}</h2>
                            <p class="excert">{{ $post->content }}</p>
                        </div>
                    </div>
                    <div class="comments-area">
                        <h4>Comments</h4>
                        <div class="comments-append" style="overflow: scroll; max-height: 450px; overflow-x: hidden">
                            @foreach ($post->comments as $comment)
                                <div class="comment-list pr-3">
                                    <div class="single-comment justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb">
                                                <img class="rounded-circle" src="{{ asset($comment->user->image) }}"
                                                    alt="{{ $comment->id }}" width="60" height="60">
                                            </div>
                                            <div class="desc">
                                                <h5>
                                                    <a href="#">{{ $comment->user->name }}</a>
                                                </h5>
                                                <p class="date">{{ $comment->created_at }}</p>
                                                <p class="comment">{{ $comment->comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if (Auth::check())
                        <div class="comment-form">
                            <h4>Leave a Comment</h4>
                            <form id="commentForm" post_id="{{ $post->id }}">
                                <div class="form-group">
                                    <textarea class="form-control mb-10" rows="5" name="comment"
                                        placeholder="Leave a comment" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Leave a comment'"></textarea>
                                </div>
                                <button type="submit" class="button button-postComment button--active">Comment</button>
                            </form>
                        </div>
                    @endif
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

@section('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#commentForm").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('comment.store') }}",
                    data: {
                        comment: $("textarea[name='comment']").val(),
                        post_id: $("#commentForm").attr('post_id')
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.err) {
                            toastr["error"](response.err);
                            toastr.options = {
                                "timeOut": "1000",
                            }
                        } else {
                            $("textarea[name='comment']").val("");
                            $(".comments-append").append(response.html);
                            toastr["success"](response.msg);
                            toastr.options = {
                                "timeOut": "1000",
                            }
                        }
                    },
                    error: function(response) {
                        $.each(response.responseJSON.errors, function(key, val) {
                            toastr["error"](val);
                            toastr.options = {
                                "timeOut": "1000",
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
