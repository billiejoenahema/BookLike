<div class="col-md-8 mb-3">
    <div class="card">
        <div class="d-inline-flex">
            <div class="p-3 d-flex flex-column">
                @if($login_user->profile_image == null)
                    <img src="{{ $default_image }}" class="rounded-circle" width=100 height="100">
                @else
                    <img src="{{ asset('storage/profile_image/'.$login_user->profile_image) }}" class="rounded-circle" width="100" height="100">
                @endif
            <div class="mt-3 d-flex flex-column">
                    <h4 class="mb-0 font-weight-bold">{{ $login_user->name }}</h4>
                    <span class="text-secondary">{{ $login_user->screen_name }}</span>
                </div>
            </div>
            <div class="p-3 d-flex flex-column justify-content-between">
                <div class="d-flex">
                    <div class="d-flex">
                        <a href="{{ url('users/' .$login_user->id .'/edit') }}" class="btn btn-primary">プロフィールを編集する</a>
                        <form method="POST" action="{{ route('users.destroy', $login_user->id) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger ml-3">
                                {{ __('アカウント削除') }}
                            </button>
                        </form>
                    </div>
                </div>
                <div class="d-flex">
                    <p>{{ $login_user->description }}</p>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">レビュー数</p>
                        <span>{{ $review_count }}</span>
                    </div>
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">フォロー数</p>
                        <a href="{{ url('/users/' .$login_user->id .'/following') }}">{{ $follow_count }}</a>
                    </div>
                    <div class="p-2 d-flex flex-column align-items-center">
                        <p class="font-weight-bold">フォロワー数</p>
                        <span>{{ $follower_count }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
