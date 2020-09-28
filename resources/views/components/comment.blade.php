<div class="row justify-content-center">
    <div class="col-md-8 mb-3">
        <ul class="list-group">
            @forelse ($comments as $comment)
                <li class="list-group-item">
                    <div class="py-3 w-100">
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
                    <p class="mb-0 text-secondary">コメントはまだありません</p>
                </li>
            @endforelse
        </ul>
        <div class="text-right">
            <button type="button" class="btn btn-primary mt-3 justify-content-end" data-toggle="modal" data-target="#exampleModalCenter">
                コメントを投稿する
            </button>
        </div>
    </div>
</div>

<!-- Comment Post Modal -->
<div class=" modal fade form-group row m-auto" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <img src="{{ asset('storage/profile_image/'.$login_user->profile_image) }}" class="rounded-circle" width="50" height="50">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('comments.store') }}">
                <div class="modal-body py-0">
                    @csrf
                        <input type="hidden" name="review_id" value="{{ $review->id }}">
                        <textarea class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="4">{{ old('text') }}</textarea>
                        @error('text')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="mb-4 text-danger mr-0">200文字以内</p>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        投稿する
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
