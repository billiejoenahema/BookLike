<div class="row justify-content-center">
    <div class="col-md-8 mb-3">
        <ul class="list-group">
            @forelse ($comments as $comment)
                <li class="list-group-item">
                    <div class="py-3 w-100 d-flex">
                        @include('components.user_image', ['user' => $comment->user])
                        <div class="ml-2 d-flex flex-column">
                            <p class="mb-0">{{ $comment->user->name }}</p>
                            <span class="text-secondary">{{ $comment->user->screen_name }}</span>
                        </div>
                        <div class="d-flex justify-content-end flex-grow-1">
                            <p class="mb-0 text-secondary">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                    <div class="py-3">
                        {!! nl2br(e($comment->text)) !!}
                    </div>
                </li>
            @empty
                <li class="list-group-item">
                    <p class="mb-0 text-secondary">コメントはまだありません。</p>
                </li>
            @endforelse
            <li class="list-group-item">
                <div class="py-3">
                    <form method="POST" action="{{ route('comments.store') }}">
                        @csrf

                        <div class="form-group row mb-0">
                            <div class="col-md-12 p-3 w-100 d-flex">
                            @if($login_user->profile_image == null)
                                <img src="{{ asset('storage/profile_image/Default_User_Icon.jpeg') }}" class="rounded-circle" width="50" height="50">
                            @else
                                <img src="{{ asset('storage/profile_image/'.$login_user->profile_image) }}" class="rounded-circle" width="50" height="50">
                            @endif
                            <div class="ml-2 d-flex flex-column">
                                    <p class="mb-0">{{ $login_user->name }}</p>
                                    <span class="text-secondary">{{ $review->user->screen_name }}</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="review_id" value="{{ $review->id }}">
                                <textarea class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="4">{{ old('text') }}</textarea>

                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <p class="mb-4 text-danger">200文字以内</p>
                                <button type="submit" class="btn btn-primary shadow-sm">
                                    投稿する
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
