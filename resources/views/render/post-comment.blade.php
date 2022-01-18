<div class="comment-list pr-3">
    <div class="single-comment justify-content-between d-flex">
        <div class="user justify-content-between d-flex">
            <div class="thumb">
                <img class="rounded-circle" src="{{ asset($comment->user->image) }}" alt="{{ $comment->id }}"
                    width="60" height="60">
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
