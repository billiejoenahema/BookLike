<div class="card shadow-sm mb-4">
  <div class="d-sm-inline-flex">
    <div id="profile-follow-button" class="d-flex flex-wrap mb-3">
      @if ($login_user->isFollowed($user->id))
      {{-- フォローされているかどうか --}}
      <div class="text-secondary mr-1 mr-sm-2 mr-md-3 mr-lg-4">
        <i class="far fa-laugh"></i>フォローされています
      </div>
      @endif
      {{-- フォローボタン --}}
      <div id="followButtonWrapper"></div>
    </div>
    <div class="col-12 col-sm-4
      mt-5
      pt-3
      px-3
      pb-0
      p-sm-3
      d-flex
      flex-row flex-sm-column
    ">
      <img src="{{ $storage->url($user->profile_image) }}"
        class="rounded-circle shadow-sm" width="100" height="100"
        loading='lazy' />
      <div class="mt-3 pl-3 pl-sm-0 d-flex flex-column">
        <h4 class="mb-0 font-weight-bold">
          {{ $user->name ?? $user->screen_name }}
        </h4>
        <span class="text-secondary">{{ $user->screen_name }}</span>
        {{-- いいね獲得数 --}}
        <div id="favoritesCountTotalWrapper" class="mt-2"></div>
      </div>
    </div>
    <div class="col-12 col-sm-8 mt-sm-5 p-3 d-flex flex-column">
      <div class="d-flex flex-wrap text-secondary mb-1">
        <span class="pr-5">登録日: {{ $create_date }}</span>
        <span>更新日: {{ $update_date }}</span>
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
  <details class="card mx-3 mb-3 pt-0 border-0">
    <summary class="
                text-left
                user-select-none
                text-white
                font-weight-bold
                bg-blog
                shadow-sm
            ">
      <i class="fas fa-fx fa-lg fa-angle-down mr-1 align-middle"></i>
      My Best Book
    </summary>
    <div class="mt-3 mb-3">
      <div class="float-left mr-3 w-25 h-25 text-center">
        <img src="{{ $book->image }}" class="shadow-sm w-100 h-100" alt=""
          loading='lazy' />
        <a href="{{ $book->url }} " target="_blank" rel="noopener"
          title="Amazonサイトへ移動" class="amazon-link"><i class="fab fa-amazon"></i>
          Amazon</a>
      </div>
      <h5>{{ $book->title }}</h5>
      <span
        class="border-bottom font-weight-bold text-blogDark">この本を選んだ理由</span>
      <p class="flex-wrap">{{ $user->story ?? '設定されていません' }}</p>
    </div>
  </details>
</div>
