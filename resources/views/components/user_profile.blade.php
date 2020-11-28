<div class="card shadow-sm mb-4">
    <div class="d-sm-inline-flex">
        <div class="col-12 col-sm-4 pt-4 px-4 pb-0 p-sm-4 d-flex flex-row flex-sm-column">
            <img src="{{ $storage->url($user->profile_image) }}" class="rounded-circle shadow-sm" width="100"
                height="100">
            <div class="mt-3 pl-4 pl-sm-0 d-flex flex-column">
                <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
                <span class="text-secondary">{{ $user->screen_name }}</span>
            </div>
        </div>
        <div class="col-12 col-sm-8 p-4 d-flex flex-column justify-content-between">
            <!-- フォロー関係 -->
            <div class="d-flex flex-wrap justify-content-between justify-content-end mb-3">
                @if ($login_user->isFollowed($user->id))
                <div class="">
                    <span class="text-secondary"><i class="far fa-laugh"></i>フォローされています</span>
                </div>
                @endif
                {{-- @include('components.follow_button') --}}
                <div id="userProfileFollowButton"></div>
            </div>
            <div class="flex-column">
                <span class="font-weight-bold">好きなジャンル</span>
                <p>{{ $user->category }}</p>
            </div>
            <div class="flex-column">
                <span class="font-weight-bold">自己紹介</span>
                <p>{{ $user->description }}</p>
            </div>
        </div>
    </div>
</div>
