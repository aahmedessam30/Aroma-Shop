@extends('layouts.main')

@section('title', 'Blog')

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
    <section class="blog_area mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog_left_sidebar">
                        <div class="alert alert-success text-center" id="success-message" style="display: none"></div>
                        <div class="alert alert-danger text-center" id="fail-message" style="display: none"></div>
                        @if (Auth::check())
                            <div class="share border bg-white mb-4">
                                <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" name="title" id="title"
                                        class="d-flex flex-row inputs p-3 pt-4 border-0 form-control share-input"
                                        placeholder="Post Title">

                                    <textarea type="text" rows="3" name="content" id="content"
                                        class="d-flex flex-row inputs p-3 py-3 border-0 form-control"
                                        placeholder="What's in your mind?"></textarea>

                                    <div class="d-flex flex-row justify-content-between border-top">
                                        <div class="d-flex flex-row publish-options">
                                            <input type="file" name="image" id="file" class="inputfile">
                                            <label for="file" class="align-items-center border"><i
                                                    class="fa fa-camera"></i>
                                                Photo</label>

                                            <select class="form-select h-100 border-left-0" name="post_category_id"
                                                id="category">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="publish-button">
                                            <button type="submit"
                                                class="align-items-center border-left p-2 px-5 btn publish">
                                                <span class="ml-1">Post</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                        @foreach ($posts as $post)
                            <article class="row blog_item {{ $post->id }}">
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
                                <div class="col-md-9">
                                    <div class="blog_post">
                                        <img src="{{ asset($post->image) }}" alt="{{ $post->id }}">
                                        <div class="blog_details">
                                            <a href="{{ route('blog.show', $post->id) }}">
                                                <h2>{{ $post->title }}</h2>
                                            </a>
                                            <p>{{ $post->content }}</p>
                                            <a class="button button-blog" href="{{ route('blog.show', $post->id) }}">View
                                                More</a>

                                            @if (Auth::id() == $post->user_id)
                                                <a class="btn btn-success ml-1" id="edit-btn"
                                                    href="{{ route('blog.edit', $post->id) }}">Edit</a>
                                                <button class="btn btn-danger ml-1"
                                                    onclick="deletePost('{{ route('blog.destroy', $post->id) }}')">Delete</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                        <nav class="blog-pagination justify-content-center d-flex mb-5"
                            style="padding-left: 10rem!important;">
                            <ul class="pagination">
                                {{ $posts->links() }}
                            </ul>
                        </nav>
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
                                        <a href="{{ route('blog.filter', $category->id) }}"
                                            class="d-flex justify-content-between cats">
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
                                @foreach ($categories as $category)
                                    <li>
                                        <a class="cats"
                                            href="{{ route('blog.filter', $category->id) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
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
    @if (Session::has('success'))
        <script>
            toastr["success"]("{{ Session::get('success') }}");
        </script>
    @endif
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /************************Fliter************************/

            $('.cats').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: $(this).attr('href'),
                    success: function(response) {
                        $(".blog_left_sidebar").empty();
                        $(".blog_left_sidebar").html(response.html);
                    }
                });
            });

        });

        /************************Delete************************/

        function deletePost(url) {
            $.ajax({
                type: "delete",
                url: url,
                success: function(response) {
                    $("." + response.id).remove();
                    toastr["success"](response.msg);
                    toastr.options = {
                        "timeOut": "1000",
                    }
                },
            });
        }
    </script>
@endsection
