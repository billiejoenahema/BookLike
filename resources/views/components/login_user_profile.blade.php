<div class="card shadow-sm mb-4" id="userProfileCard">
    <div class="d-sm-inline-flex">
        {{-- プロフィール編集ボタン --}}
        <div id="profile-edit-button">
            <a class="btn text-white p-1" href="{{ url('users/' .$login_user->id .'/edit') }}" role="button"
                id="editButton" data-toggle="tooltip" data-placement="top" title="プロフィール編集"><i
                    class="fas fa-fx fa-lg fa-user-edit"></i></a>
        </div>
        <div class="col-12 col-sm-4 pt-3 px-3 pb-0 p-sm-3 d-flex flex-row flex-sm-column">
            <a href="{{ url('users/' .$login_user->id .'/edit') }}">
                <img src="{{ $storage->url($login_user->profile_image) }}" class="rounded-circle shadow-sm" width="100"
                    height="100" title="プロフィール編集">
            </a>
            <div class="mt-3 pl-3 pl-sm-0 d-flex flex-column">
                <h5 class="mb-0 font-weight-bold">{{ $login_user->name ?? $login_user->screen_name}}</h5>
                <span class="text-secondary">{{ $login_user->screen_name }}</span>
                {{-- いいね獲得数 --}}
                <div id="totalFavoritesCount" class="mt-2"></div>
            </div>
        </div>
        <div class="col-12 col-sm-8 p-3 d-flex flex-column">
            <div class="d-flex flex-wrap text-secondary mb-1">
                <span class="pr-4">登録日: {{ $create_date }}</span>
                <span>更新日: {{ $update_date }}</span>
            </div>
            <div class="d-flex flex-column">
                <span class="font-weight-bold">好きなジャンル</span>
                <p>{{ $login_user->category }}</p>
            </div>
            <div class="d-flex flex-column">
                <span class="font-weight-bold">自己紹介</span>
                <p>{{ $login_user->description }}</p>
            </div>
        </div>
    </div>
    <details class="card mx-3 mb-3 pt-0 border-0">
        <summary class="btn text-left shadow-none user-select-none text-white font-weight-bold bg-blog shadow-sm"><i
                class="fas fa-fx fa-lg fa-angle-down mr-1 align-middle"></i>
            My Best Book
        </summary>
        <div class="mt-3 mb-3">
            <div class="float-left mr-3 w-25 h-25 text-center">
                <img src="{{ $book_image }}" class="shadow-sm w-100 h-100" alt="">
                <a href="{{ $book_url }} " target="_blank" rel="noopener" title="Amazonサイトへ移動"><i
                        class="fab fa-amazon"></i> Amazon</a>
            </div>
            <h5>{{ $book_title }}</h5>
            <span class=" border-bottom font-weight-bold text-blogDark">この本を選んだ理由</span>
            <p class="flex-wrap">{{ $login_user->story ?? '設定されていません' }}</p>
        </div>
    </details>
</div>
