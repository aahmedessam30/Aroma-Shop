@extends('layouts.main')

@section('title', 'Prodcut Details')

@section('content')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="blog">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Prodcut Details</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Prodcut Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->


    <!--================Single Product Area =================-->
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="owl-carousel owl-theme s_Product_carousel">
                        <div class="single-prd-item">
                            <img class="img-fluid" src="{{ $prodcut->image }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{ $prodcut->name }}</h3>
                        <h2>${{ $prodcut->price }}</h2>
                        <ul class="list">
                            <li><a class="active" href="#"><span>Category</span> :
                                    {{ $prodcut->category->name }}</a></li>
                            <li><a href="#"><span>Availibility</span> : {{ $prodcut->availibility }}</a></li>
                        </ul>
                        <p>{{ $prodcut->description }}</p>
                        <div class="product_count">
                            <label for="qty">Quantity:</label>
                            <button
                                onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                class="increase items-count" type="button"><i class="ti-angle-left"></i></button>
                            <input type="text" name="qty" id="sst" value="{{ $prodcut->quantity }}" title="Quantity:"
                                class="input-text qty">
                            <button
                                onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                class="reduced items-count" type="button"><i class="ti-angle-right"></i></button>
                            <a class="button primary-btn" href="#">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Specification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                        aria-controls="contact" aria-selected="false">Comments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                        aria-controls="review" aria-selected="false">Reviews</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5>Width</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $prodcut->specification->width }}mm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Height</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $prodcut->specification->height }}mm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Depth</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $prodcut->specification->depth }}mm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Weight</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $prodcut->specification->weight }}gm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Quality checking</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $prodcut->specification->quality_checking }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Freshness Duration</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $prodcut->specification->created_at }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>When packeting</h5>
                                    </td>
                                    <td>
                                        <h5>Without touch of hand</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row mt-4 mb-5">
                        <div class="col-lg-6">
                            <div class="comment_list" style="max-height: 563px; overflow: auto">
                                @if ($prodcut->comments->count() > 0)
                                    @foreach ($prodcut->comments as $comment)
                                        <div class="review_item pr-3">
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img class="rounded-circle" src="{{ asset($comment->user->image) }}"
                                                        alt="{{ $comment->user_id }}">
                                                </div>
                                                <div class="media-body">
                                                    <h4>{{ $comment->user->name }}</h4>
                                                    <h5>{{ $comment->created_at }}</h5>
                                                    <button class="reply_btn"
                                                        onclick="reply('{{ $comment->id }}')">Reply</button>
                                                </div>
                                            </div>
                                            <p>{{ $comment->comment }}</p>
                                        </div>
                                        @foreach ($comment->replies as $reply)
                                            <div class="review_item reply p-2">
                                                <div class="media">
                                                    <div class="d-flex">
                                                        <img class="rounded-circle"
                                                            src="{{ asset($reply->user->image) }}"
                                                            alt="{{ $reply->user_id }}">
                                                    </div>
                                                    <div class="media-body">
                                                        <h4>{{ $reply->user->name }}</h4>
                                                        <h5>{{ $reply->created_at }}</h5>
                                                    </div>
                                                </div>
                                                <p>{{ $reply->reply }}</p>
                                            </div>
                                        @endforeach
                                        <hr class="mr-4">
                                    @endforeach
                                @else
                                    <p>No Comments Yet</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <form action="{{ route('comment.store') }}" method="POST" class="form-contact form-review">
                                @csrf
                                <div class="review_box">
                                    <h4>Post a comment</h4>
                                    <div class="form-group">
                                        <textarea class="form-control different-control w-100" id="comment" cols="30"
                                            rows="5" value="{{ old('comment') }}" placeholder="Enter Your Comment"
                                            required></textarea>
                                    </div>
                                    <div class="form-group text-center text-md-right mt-3">
                                        <button type="submit" id="comment-btn" class="button button--active button-review">
                                            Submit Now
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <form id="replyForm" style="display: none">
                                @csrf
                                <div class="review_box">
                                    <h4>Reply On Comment</h4>
                                    <div class="form-group">
                                        <textarea class="form-control different-control w-100" name="reply" cols="30"
                                            rows="5" value="{{ old('reply') }}" placeholder="Enter Your Reply"
                                            required></textarea>
                                    </div>
                                    <div class="form-group text-center text-md-right mt-3">
                                        <button type="submit" class="button button--active button-review">
                                            Submit Now
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row total_rate">
                                <div class="col-6">
                                    <div class="box_total">
                                        <h3>Based on {{ count($prodcut->reviews) }} Reviews</h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="rating_list">
                                        <ul class="list">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <li>{{ $i }} Star
                                                    @for ($j = 1; $j <= $i; $j++)
                                                        <i class="fa fa-star text-primary"></i>
                                                    @endfor
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="review_list" style="max-height: 563px; overflow: auto">
                                @if ($prodcut->reviews->count() > 0)
                                    @foreach ($prodcut->reviews as $review)
                                        <div class="review_item pr-1">
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img class="rounded-circle im"
                                                        src="{{ asset($review->user->image) }}"
                                                        alt="{{ $review->user_id }}">
                                                </div>
                                                <div class="media-body">
                                                    <h4>{{ $review->user->name }}</h4>
                                                    @if ($review->rate == 0)
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="fa fa-star zero-star"></i>
                                                        @endfor
                                                    @endif
                                                    @for ($i = 1; $i <= $review->rate; $i++)
                                                        <i class="fa fa-star text-primary"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <p>{{ $review->review }}</p>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No Reviews Yet</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <form action="{{ route('review.store') }}" method="POST"
                                class="form-contact form-review mt-3">
                                @csrf
                                <div class="review_box">
                                    <h4>Add a Review</h4>
                                    <div class="container rate">
                                        <div class="row">
                                            <p class="rateP">Your Rating:</p>
                                            @for ($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="star{{ $i }}" name="rate"
                                                    value="{{ $i }}" />
                                                <label for="star{{ $i }}" title="text">{{ $i }}
                                                    stars</label>
                                            @endfor
                                            <p class="outstanding">Outstanding</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control different-control w-100" id="textarea" cols="30"
                                            rows="5" value="{{ old('review') }}" placeholder="Enter Your Review"
                                            required></textarea>
                                    </div>
                                    <div class="form-group text-center text-md-right mt-3">
                                        <button type="submit" id="review-btn"
                                            class="button button--active button-review">Submit
                                            Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Product Description Area =================-->

@endsection

@section('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*========== Review ==========*/

            var rate = [];

            $("#review-btn").click(function(e) {
                e.preventDefault();
                rate = [];

                if (!$('input[name="rate"]').is(':checked')) {
                    rate = 0;
                } else {
                    $('input[name="rate"]:checked').each(function() {
                        rate.push($(this).val());
                    });
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('review.store') }}",
                    data: {
                        prodcut_id: {{ $prodcut->id }},
                        rate: rate,
                        review: $('#textarea').val(),
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.err) {
                            toastr["error"](response.err);
                            toastr.options = {
                                "timeOut": "1000",
                            }
                        } else {
                            $("#textarea").val("");
                            $(".review_list").append(response.html);
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

            /*========== Comment ==========*/

            $("#comment-btn").click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('comment.store') }}",
                    data: {
                        prodcut_id: {{ $prodcut->id }},
                        comment: $('#comment').val(),
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.err) {
                            toastr["error"](response.err);
                            toastr.options = {
                                "timeOut": "1000",
                            }
                        } else {
                            $("#comment").val("");
                            $(".comment_list").append(response.html);
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

            /*========== Reply ==========*/

            $("#replyForm").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('reply.store') }}",
                    data: {
                        comment_id: $("#replyForm").attr('form-id'),
                        reply: $("textarea[name='reply']").val(),
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.err) {
                            toastr["error"](response.err);
                            toastr.options = {
                                "timeOut": "1000",
                            }
                        } else {
                            $("textarea[name='reply']").val("");
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

        function reply(id) {
            $("#replyForm").attr('form-id', id).show();
        }
    </script>
@endsection
