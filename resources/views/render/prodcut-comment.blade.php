<div class="review_item pr-3">
    <div class="media">
        <div class="d-flex">
            <img class="rounded-circle" src="{{ asset($comment->user->image) }}" alt="{{ $comment->user_id }}">
        </div>
        <div class="media-body">
            <h4>{{ $comment->user->name }}</h4>
            <h5>{{ $comment->created_at }}</h5>
            <input type="hidden" value="{{ $comment->id }}" class="hidden">
            <button class="reply_btn reply-button{{ $comment->id }}">Reply</button>
        </div>
    </div>
    <p>{{ $comment->comment }}</p>
</div>
@foreach ($comment->replies as $reply)
    <div class="review_item reply p-2">
        <div class="media">
            <div class="d-flex">
                <img class="rounded-circle" src="{{ asset($reply->user->image) }}" alt="{{ $reply->user_id }}">
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
