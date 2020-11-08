<div class="card shadow-sm mb-4">
    <div class="d-inline-flex">
        <div class="col-4 p-3 d-flex flex-column">
            <a href="{{ url('users/' .$user->id) }}">
                <img src="{{ $storage->url($user->profile_image) }}" class="rounded-circle shadow-sm" width="100"
                    height="100">
            </a>
            <div class="mt-3 d-flex flex-column">
                <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
                <span class="text-secondary">{{ $user->screen_name }}</span>
            </div>
        </div>
        <div class="col-8 p-3 d-flex flex-column justify-content-between">
            <div class="d-flex flex-wrap justify-content-sm-between justify-content-end mb-3">
                <div class="d-flex flex-sm-column">
                    @if ($login_user->isFollowed($user->id))
                    <div class="mb-1">
                        <span class="text-secondary"><i class="far fa-laugh"></i>フォローされています</span>
                    </div>
                    @endif
                </div>
                <div id="userProfileFollowButton"></div>
            </div>
            <div class="d-flex">
                <p>{{ $user->description }}</p>
            </div>
        </div>
    </div>
</div>
