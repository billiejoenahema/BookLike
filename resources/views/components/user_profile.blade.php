<div class="card shadow-sm mb-5">
    <div class="d-inline-flex">
        <div class="p-3 d-flex flex-column">
            <a href="{{ url('users/' .$login_user->id) }}">
                <img src="{{ asset('storage/profile_image/'.$user->profile_image) }}" class="rounded-circle shadow-sm" width="100" height="100">
            </a>
            <div class="mt-3 d-flex flex-column">
                <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
                <span class="text-secondary">{{ $user->screen_name }}</span>
            </div>
        </div>
        <div class="p-3 d-flex flex-column justify-content-between">
            <!-- フォロー関係 -->
            <div class="d-flex flex-wrap">
                <div class="d-flex flex-sm-column">
                    @if ($login_user->isFollowed($user->id))
                    <div class="mb-1 mr-3">
                        <span class="text-secondary"><i class="far fa-laugh"></i>フォローされています</span>
                    </div>
                    @endif
                </div>
                <div class="d-flex">
                    @if ($is_following)
                    <form action="{{ route('unfollow', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-sm btn-primary shadow-sm rounded-pill">フォロー中</button>
                    </form>
                    @else
                    <form action="{{ route('follow', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-sm btn-outline-primary shadow-sm rounded-pill">フォローする</button>
                    </form>
                    @endif
                </div>
            </div>

            <div class="d-flex">
                <p>{{ $user->description }}</p>
            </div>
        </div>
    </div>

    <div class="card-footer d-flex flex-row pb-0 px-0">
        <div class="w-25 align-items-center d-flex flex-column">
            <span class="font-weight-bold small">投稿</span>
            <span>{{ $review_count }}</span>
        </div>
        <div class="w-25 align-items-center d-flex flex-column">
            <span class="font-weight-bold small">いいねした投稿</span>
            <span>{{ $favorite_reviews_count }}</span>
        </div>
        <div class="w-25 align-items-center d-flex flex-column">
            <span class="font-weight-bold small">フォロー</span>
            <span>{{ $follow_count }}</span>
        </div>
        <div class="w-25 align-items-center d-flex flex-column">
            <span class="font-weight-bold small">フォロワー</span>
            <span>{{ $follower_count }}</span>
        </div>
    </div>
</div>
