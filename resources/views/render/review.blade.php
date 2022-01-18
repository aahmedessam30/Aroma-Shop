<div class="review_item pr-1">
    <div class="media">
        <div class="d-flex">
            <img class="rounded-circle im" src="{{ asset($review->user->image) }}" alt="{{ $review->user_id }}">
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
