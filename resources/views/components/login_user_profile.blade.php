<div class="card shadow-sm mb-5">
    <div class="card-body d-flex">
        <div class="col-4 d-flex flex-column p-0">
            <a href="{{ url('users/' .$login_user->id) }}">
                <img src="{{ asset('storage/profile_image/'.$login_user->profile_image) }}"
                class="rounded-circle shadow-sm img-fluid"
                width="100"
                height="100">
            </a>
            <div class="mt-3 d-flex flex-column">
                <h5 class="mb-0 font-weight-bold">{{ $login_user->name }}</h5>
                <span class="text-secondary">{{ $login_user->screen_name }}</span>
            </div>
        </div>
        <div class="flex-column w-100">
            <div class="d-flex justify-content-end">
                <a class="btn dropdown-toggle justify-content-end pt-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                @if($login_user->id == 1)
                    <span class="dropdown-item disabled">プロフィール編集</span>
                @else
                    <a href="{{ url('users/' .$login_user->id .'/edit') }}"
                        class="dropdown-item text-reset">
                        プロフィール編集
                    </a>
                @endif
                    <a href="#"
                        class="dropdown-item text-decoration-none disabled"
                        data-toggle="modal"
                        data-target="#exampleModalCenter"
                        role="button">
                        アカウントを削除
                    </a>
                </div>
            </div>
            <div>{{ $login_user->description }}</div>
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


