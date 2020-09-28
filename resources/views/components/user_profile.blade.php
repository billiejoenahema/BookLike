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

    <div class="card-footer border-top-0 d-flex flex-row justify-content-around">
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

</div>
