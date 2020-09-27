<div class="card shadow-sm mb-5">
    <div class="d-sm-flex">
        <div class="p-3 d-flex flex-column">
            <a href="{{ url('users/' .$login_user->id) }}">
                <img src="{{ asset('storage/profile_image/'.$login_user->profile_image) }}"
                class="rounded-circle shadow-sm img-fluid"
                width="100"
                height="100">
            </a>
            <div class="mt-3 d-flex flex-column">
                <h4 class="mb-0 font-weight-bold">{{ $login_user->name }}</h4>
                <span class="text-secondary">{{ $login_user->screen_name }}</span>
            </div>
        </div>
        <div class="p-3 flex-column">
            @if($login_user->id == 1)
            <div class="btn btn-secondary disabled mb-3">ゲストユーザーはプロフィールを編集できません</div>
            @else
            <div class="d-flex">
                <div class="p-1">
                    <a href="{{ url('users/' .$login_user->id .'/edit') }}" class="btn btn-primary">プロフィールを編集する</a>
                </div>
                <div class="dropdown p-1">
                    <a class="btn dropdown-toggle"
                    href="#" role="button"
                    id="dropdownMenuLink"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"></a>
                    <div class="dropdown-menu mb-3 text-center" aria-labelledby="dropdownMenuLink">
                        <a href="#"
                            class="text-reset text-danger"
                            data-toggle="modal"
                            data-target="#exampleModalCenter"
                            role="button">アカウントを削除</a>
                    </div>
                </div>
            </div>
            @endif
            <div class="d-flex">
                <p>{{ $login_user->description }}</p>
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
<!-- Confirm Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">本当にアカウントを削除しますか？</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">「削除する」を押すとあなたのアカウント情報はすべて失われます</div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                    <form method="POST" action="{{ route('users.destroy', $login_user->id) }}" id="delete_{{ $login_user->id }}">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除する</button>
                    </form>
            </div>
        </div>
    </div>
</div>


