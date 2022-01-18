@foreach ($posts as $post)
    <article class="row blog_item">
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
                <img src="{{ $post->image }}" alt="">
                <div class="blog_details">
                    <a href="{{ route('blog.show', $post->id) }}">
                        <h2>{{ $post->title }}</h2>
                    </a>
                    <p>{{ $post->content }}</p>
                    <a class="button button-blog" href="{{ route('blog.show', $post->id) }}">View
                        More</a>
                </div>
            </div>
        </div>
    </article>
@endforeach
<nav class="blog-pagination justify-content-center d-flex mb-5" style="padding-left: 10rem!important;">
    <ul class="pagination">
        {{ $posts->links() }}
    </ul>
</nav>
</div>
