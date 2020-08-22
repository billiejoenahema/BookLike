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
                @if($login_user->id == 1)
                <div class="btn btn-secondary disabled mb-3">
                    {{ __('ゲストユーザーはプロフィールを編集できません') }}
                </div>
                @else
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

                        <div class="dropdown-menu mb-3" aria-labelledby="dropdownMenuLink">
                            <form method="POST" action="{{ route('users.destroy', $login_user->id) }}" id="delete_{{ $login_user->id }}">
                                @csrf
                                @method('DELETE')
                                <a class="dropdown-item text-danger"
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
                @endif
                <div class="d-flex">
                    <p>{{ $login_user->description }}</p>
                </div>

                <div class="d-flex justify-content-end">
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">レビュー</p>
                        <a class="btn bg-light" href="{{ url('users/' .$user->id) }}">{{ $review_count }}</a>
                    </div>
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">フォロー</p>
                        <a class="btn bg-light" href="{{ url('/users/' .$user->id .'/following') }}">{{ $follow_count }}</a>
                    </div>
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">フォロワー</p>
                        <a class="btn bg-light" href="{{ url('/users/' .$user->id .'/followers') }}">{{ $follower_count }}</a>
                    </div>
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">いいねしたレビュー</p>
                        <a class="btn bg-light" href="{{ url('/users/' .$user->id .'/favorite') }}">{{ $favorite_reviews_count }}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/js/deletePost.js') }}"></script>
