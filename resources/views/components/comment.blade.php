<div class="row justify-content-center">
    <div class="col-md-8 mb-3">
        <ul class="list-group">
            @forelse ($comments as $comment)
                <li class="list-group-item p-0">
                @if ($comment->deleted_at !== null)
                    <div class="mx-3 my-5 text-secondary">このコメントは削除されました</div>
                @else
                    <div class="card-header border-bottom-0 bg-white d-flex flex-row justify-content-between">
                        <div class="d-flex flex-row">
                            @include('components.user_image', ['user' => $comment->user])
                            <div class="ml-2 d-flex flex-column justify-content-between">
                                <p class="mb-0">{{ $comment->user->name }}</p>
                                <span class="text-secondary">{{ $comment->user->screen_name }}</span>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="text-right lead" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-angle-down"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right p-2">
                                <form method="POST" action="{{ route('comments.destroy', $comment->id) }}" id="delete_{{ $comment->id }}">
                                @csrf
                                @method('DELETE')
                                    <a href="#"
                                        data-id="{{ $comment->id }}"
                                        onclick="deletePost(this)"
                                        class="dropdown-item text-danger d-block">
                                        <i class="fas fa-trash mr-1"></i><span>コメントを削除</span>
                                    </a>
                                </form>
                            </div>
                            <span class="text-secondary">{{ $comment->created_at->format('Y-m-d') }}</span>
                        </div>
                    </div>
                    <div class="card-body mb-3">
                        {!! nl2br(e($comment->text)) !!}
                    </div>
                @endif
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
