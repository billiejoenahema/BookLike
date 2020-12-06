<div class="card shadow-sm mb-4">
    <div class="d-sm-inline-flex">
        <div class="col-12 col-sm-4 pt-3 px-3 pb-0 p-sm-3 d-flex flex-row flex-sm-column">
            <a href="{{ url('users/' .$login_user->id .'/edit') }}">
                <img src="{{ $storage->url($login_user->profile_image) }}" class="rounded-circle shadow-sm" width="100"
                    height="100">
            </a>
            <div class="mt-3 pl-3 pl-sm-0 d-flex flex-column">
                <h5 class="mb-0 font-weight-bold">{{ $login_user->name ?? $login_user->screen_name}}</h5>
                <span class="text-secondary">{{ $login_user->screen_name }}</span>
            </div>
        </div>
        <div class="col-12 col-sm-8 p-3 d-flex flex-column">
            <div class="text-right">
                <a class="btn text-secondary text-right pt-0" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        class="fas fa-fx fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    @if($login_user->id == 1)
                    <span class="dropdown-item disabled">プロフィールを編集</span>
                    <span class="dropdown-item disabled">アカウントを完全に削除</span>
                    @else
                    <a href="{{ url('users/' .$login_user->id .'/edit') }}" class="dropdown-item text-reset">
                        プロフィールを編集
                    </a>
                    <a href="#" class="dropdown-item text-decoration-none text-danger" data-toggle="modal"
                        data-target="#exampleModalCenter" role="button">
                        アカウントを完全に削除
                    </a>
                    @endif
                </div>
            </div>

            <div class="flex-column">
                <span class="font-weight-bold">好きなジャンル</span>
                <p>{{ $login_user->category }}</p>
            </div>
            <div class="flex-column">
                <span class="font-weight-bold">自己紹介</span>
                <p>{{ $login_user->description }}</p>
            </div>
        </div>
    </div>
    <div class="card mx-3 mb-3 pt-3 border-right-0 border-left-0 border-bottom-0">
        <span class="user-select-none font-weight-bold">いまのわたしを構成する3冊</span>
    </div>
    <div class="d-flex justify-content-between mt-0 mx-3 mb-3">
        <img src="https://m.media-amazon.com/images/I/410QuKHYY3L.jpg" id="book1" class="my-book shadow-sm" width="25%"
            onclick="bookDescription(this)" alt="ファクトフルネス">
        <img src="https://m.media-amazon.com/images/I/410QuKHYY3L.jpg" id="book2" class="my-book shadow-sm" width="25%"
            onclick="bookDescription(this)" alt="ファクトフルネス">
        <img src="https://m.media-amazon.com/images/I/410QuKHYY3L.jpg" id="book3" class="my-book shadow-sm" width="25%"
            onclick="bookDescription(this)" alt="ファクトフルネス">
    </div>
    <div class="mx-3 flex-column">
        <p id="description_book1" class="d-none description">ブック1の説明</p>
        <p id="description_book2" class="d-none description">ブック2の説明</p>
        <p id="description_book3" class="d-none description">ブック3の説明</p>
    </div>
</div>

<!-- Delete Account Confirm Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
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
                <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">キャンセル</button>
                <form method="POST" action="{{ route('users.destroy', $login_user->id) }}"
                    id="delete_{{ $login_user->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-crimson rounded-pill">削除する</button>
                </form>
            </div>
        </div>
    </div>
</div>
