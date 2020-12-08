<div class="card shadow-sm mb-4">
    <div class="d-sm-inline-flex">
        <div class="col-12 col-sm-4 pt-3 px-3 pb-0 p-sm-3 d-flex flex-row flex-sm-column">
            <img src="{{ $storage->url($user->profile_image) }}" class="rounded-circle shadow-sm" width="100"
                height="100">
            <div class="mt-3 pl-3 pl-sm-0 d-flex flex-column">
                <h4 class="mb-0 font-weight-bold">{{ $user->name ?? $user->screen_name }}</h4>
                <span class="text-secondary">{{ $user->screen_name }}</span>
                <div id="totalFavoritesCount"></div>
            </div>
        </div>
        <div class="col-12 col-sm-8 p-4 d-flex flex-column justify-content-between">
            <!-- フォロー関係 -->
            <div class="d-flex flex-wrap justify-content-between mb-3">
                @if ($login_user->isFollowed($user->id))
                <div class="">
                    <span class="text-secondary"><i class="far fa-laugh"></i>フォローされています</span>
                </div>
                @endif
                {{-- @include('components.follow_button') --}}
                <div class="justify-content-end" id="userProfileFollowButton"></div>
            </div>
            <div class="d-flex flex-column">
                <span class="font-weight-bold">好きなジャンル</span>
                <p>{{ $user->category }}</p>
            </div>
            <div class="d-flex flex-column">
                <span class="font-weight-bold">自己紹介</span>
                <p>{{ $user->description }}</p>
            </div>
        </div>
    </div>
    <details class="card mx-3 mb-3 pt-3 border-right-0 border-left-0 border-bottom-0">
        <summary class="user-select-none font-weight-bold bg-lightYellow"><i class="fas fa-fx fa-angle-down"></i>
            人生を変えた一冊
        </summary>
        <div class="mt-3 mb-3">
            <div class="float-left mr-3 w-25 h-25 text-center">
                <img src="{{ $book_image }}" class="shadow-sm w-100 h-100" alt="">
                <a href="{{ $book_url }} " target="_blank" rel="noopener" data-toggle="tooltip" data-placement="top"
                    title="Amazonサイトへ移動"><i class="fab fa-amazon"></i> Amazon</a>
            </div>
            <p class="flex-wrap">{{ $user->story }}</p>
        </div>
    </details>
</div>
