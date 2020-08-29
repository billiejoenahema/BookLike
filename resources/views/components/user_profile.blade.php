<div class="col-md-8 mb-3">
    <div class="card shadow-sm">
        <div class="d-inline-flex">
            <div class="p-3 d-flex flex-column">
            @if($user->profile_image == null)
                <img src="{{ $default_image }}" class="rounded-circle shadow-sm" width=100 height="100">
            @else
                <img src="{{ asset('storage/profile_image/'.$user->profile_image) }}" class="rounded-circle shadow-sm" width="100" height="100">
            @endif
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
                            <div class="px-2 mb-3">
                                <span class="px-1 bg-secondary text-light rounded">フォローされています</span>
                            </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-end ml-auto">
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

                <div class="d-flex flex-wrap">
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">レビュー</p>
                        <a class="btn bg-light" href="{{ url('users/' .$user->id) }}">{{ $review_count }}</a>
                    </div>
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">フォロー</p>
                        <a class="btn bg-light" href="{{ url('/users/' .$user->id .'/following') }}">{{ $follow_count }}</a>
                    </div>
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">フォロワー</p>
                        <a class="btn bg-light" href="{{ url('/users/' .$user->id .'/followers') }}">{{ $follower_count }}</a>
                    </div>
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">いいねしたレビュー</p>
                        <a class="btn bg-light" href="{{ url('/users/' .$user->id .'/favorite') }}">{{ $favorite_reviews_count }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
