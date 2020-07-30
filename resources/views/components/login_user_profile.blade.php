<div class="col-md-8 mb-3">
    <div class="card shadow-sm">
        <div class="d-inline-flex">
            <div class="p-3 d-flex flex-column">
                @if($login_user->profile_image === null)
                    <img src="{{ $default_image }}" class="rounded-circle shadow-sm" width=100 height="100">
                @else
                    <img src="{{ asset('storage/profile_image/'.$login_user->profile_image) }}" class="rounded-circle shadow-sm" width="100" height="100">
                @endif
                <div class="mt-3 d-flex flex-column">
                    <h4 class="mb-0 font-weight-bold">{{ $login_user->name }}</h4>
                    <span class="text-secondary">{{ $login_user->screen_name }}</span>
                </div>
            </div>
            <div class="p-3 flex-column">
                <div class="d-flex justify-content-between">
                    <div class="p-1">
                        <a href="{{ url('users/' .$login_user->id .'/edit') }}" class="btn btn-primary">プロフィールを編集する</a>
                    </div>
                    <div class="dropdown p-1">
                        <a class="btn dropdown-toggle"
                        href="#" role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <form method="POST" action="{{ route('users.destroy', $login_user->id) }}" id="delete_{{ $login_user->id }}">
                                @csrf
                                @method('DELETE')
                                <a class="dropdown-item"
                                    href="#"
                                    data-id="{{ $login_user->id }}"
                                    onclick="deletePost(this);"
                                >
                                    アカウントを削除
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <p>{{ $login_user->description }}</p>
                </div>

                <div class="d-flex justify-content-end">
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">レビュー数</p>
                        <a class="btn bg-light" href="#">{{ $review_count }}</a>
                    </div>
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">フォロー数</p>
                        <a class="btn bg-light" href="{{ url('/users/' .$user->id .'/following') }}">{{ $follow_count }}</a>
                    </div>
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">フォロワー数</p>
                        <a class="btn bg-light" href="{{ url('/users/' .$user->id .'/followers') }}">{{ $follower_count }}</a>
                    </div>
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">いいねしたレビュー</p>
                        <a class="btn bg-light" href="{{ url('/users/' .$user->id .'/favorite') }}">{{ __('いいね数') }}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
function  deletePost(e) {
    'use strict';
    if (confirm('アカウントを削除しますか？')) {
        const delete_id = document.getElementById('delete_' + e.dataset.id)
        delete_id.submit();
    }
};
</script>
