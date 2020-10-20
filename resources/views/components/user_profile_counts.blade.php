<div class="card-footer border-top-0 d-flex flex-row justify-content-around pt-1 pb-0">
    <div class="d-flex flex-column align-items-center p-1">
        <span class="font-weight-bold small mb-1">投稿</span>
        {{ $review_count }}
    </div>
    <div class="d-flex flex-column align-items-center p-1">
        <span class="font-weight-bold small mb-1">いいねした投稿</span>
        {{ $favorite_reviews_count }}
    </div>
    <div class="d-flex flex-column align-items-center p-1">
        <span class="font-weight-bold small mb-1">フォロー</span>
        {{ $follow_count }}
    </div>
    <div class="d-flex flex-column align-items-center p-1">
        <span class="font-weight-bold small mb-1">フォロワー</span>
        {{ $follower_count }}
    </div>
</div>
