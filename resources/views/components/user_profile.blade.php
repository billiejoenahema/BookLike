<div class="col-md-8 mb-3">
    <div class="card">
        <div class="d-inline-flex">
            <div class="p-3 d-flex flex-column">
                @include('components/user_image')
                <!-- @if($user->profile_image == null)
                    <img src="{{ $default_image }}" class="rounded-circle" width=100 height="100">
                @else
                    <img src="{{ asset('storage/profile_image/'.$user->profile_image) }}" class="rounded-circle" width="100" height="100">
                @endif -->
            <div class="mt-3 d-flex flex-column">
                    <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
                    <span class="text-secondary">{{ $user->screen_name }}</span>
                </div>
            </div>
            <div class="p-3 d-flex flex-column justify-content-between">
                <div class="d-flex">
                    <div class="d-flex">
                            @if ($is_following)
                                <form action="{{ route('unfollow', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger shadow-sm">フォロー中</button>
                                </form>
                            @else
                                <form action="{{ route('follow', $user->id) }}" method="POST">
                                @csrf
                                    @if($user != $login_user)
                                        <button type="submit" class="btn btn-primary shadow-sm">フォローする</button>
                                    @endif
                                </form>
                            @endif

                            @if ($is_followed)
                                <span class="mt-2 px-1 bg-secondary text-light">フォローされています</span>
                            @endif
                    </div>
                </div>
                <div class="d-flex">
                    <p>{{ $user->description }}</p>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">レビュー数</p>
                        <span>{{ $review_count }}</span>
                    </div>
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">フォロー数</p>
                        <a href="{{ url('/users/' .$user->id .'/following') }}">{{ $follow_count }}</a>
                    </div>
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">フォロワー数</p>
                        <span>{{ $follower_count }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
