<ul class="list-group my-3">
    @forelse ($comments as $comment)
        <li class="list-group-item p-0">
        @if ($comment->deleted_at !== null)
            <div class="p-5 text-secondary">このコメントは削除されました</div>
        @else
            <div class="card-header p-3 border-bottom-0 bg-white d-flex flex-row justify-content-between">
                <div class="d-flex flex-row">
                    @include('components.user_image', ['user' => $comment->user])
                    <div class="ml-2 d-flex flex-column justify-content-between">
                        <p class="mb-0">{{ $comment->user->name }}</p>
                        <span class="text-secondary">{{ $comment->user->screen_name }}</span>
                    </div>
                </div>
                <div class="d-flex flex-column text-right">
                    @if ($comment->user->id === $login_user->id)
                        <a href="#"
                            role="button"
                            data-toggle="modal"
                            data-target="#deleteComment"
                            class="text-secondary mb-0 d-block"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="コメント削除">
                            <i class="fas fa-trash"></i>
                        </a>
                    @endif
                    <span class="text-secondary">{{ $comment->created_at->format('Y-m-d') }}</span>
                </div>
            </div>
            <div class="card-body p-3">
                {!! nl2br(e($comment->text)) !!}
            </div>
        @endif
        </li>
        <!-- Confirm Modal -->
        <div class="modal fade" id="deleteComment" tabindex="-1" role="dialog" aria-labelledby="deleteCommentTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title font-weight-bold" id="delteReviewLongTitle">コメントを削除しますか？</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                        <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <li class="list-group-item">
            <p class="mb-0 text-secondary">コメントはまだありません</p>
        </li>
    @endforelse
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
                <form method="POST" action="{{ route('comments.store') }}" id="commentPost">
                    <div class="modal-body py-0">
                        @csrf
                            <input type="hidden" name="review_id" value="{{ $review->id }}">
                            <textarea class="form-control @error('text') is-invalid @enderror"
                            name="text"
                            id="comment"
                            required autocomplete="text"
                            rows="6"
                            autofocus
                            onkeyup="checkCommentLength(value)"
                            >{{ old('text') }}</textarea>
                            @error('text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'コメントは200字まで投稿可能です' }}</strong>
                                </span>
                            @enderror
                            <div class="text-right">
                                <p id="commentLength">0 / 200文字</p>
                            </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" onclick="commentValidate()" id="postButton" class="btn btn-primary shadow-sm">
                            投稿する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</ul>
<div class="text-right">
    <button type="button" class="btn btn-primary mt-3 justify-content-end" data-toggle="modal" data-target="#exampleModalCenter">
        コメントを投稿する
    </button>
</div>
