<h6 id="comment" class="mt-4">コメント</h6>
<ul class="list-group">
    @forelse ($comments as $comment)
    <li class="list-group-item p-0">
        @if ($comment->deleted_at)
        <div
            class="card-header p-3 border-bottom-0 bg-white d-flex flex-column"
        >
            <div class="d-flex flex-column text-right">
                <span
                    class="text-secondary"
                    >{{ $comment->created_at->format('Y/m/d') }}</span
                >
            </div>
            <div class="text-secondary">このコメントは削除されました</div>
        </div>
        @else
        <div
            class="
                card-header
                p-3
                border-bottom-0
                bg-white
                d-flex
                flex-row
                justify-content-between
            "
        >
            <div class="d-flex flex-row">
                @include('components.user_image', ['user' => $comment->user])
                <div class="ml-2 d-flex flex-column justify-content-between">
                    <p class="mb-0">{{ $comment->user->name }}</p>
                    <span
                        class="text-secondary"
                        >{{ $comment->user->screen_name }}</span
                    >
                </div>
            </div>
            <div class="d-flex flex-column text-right">
                @if ($comment->user->id === $login_user->id)
                <form
                    method="POST"
                    name="{{ 'form'.$comment->id }}"
                    action="{{ route('comments.destroy', $comment->id) }}"
                >
                    @csrf @method('DELETE')
                    <a
                        href="javascript:{{ 'form'.$comment->id }}.submit()"
                        role="submit"
                        class="text-secondary mb-0 d-block"
                        title="コメント削除"
                    >
                        <h5><i class="fas fa-trash"></i></h5>
                    </a>
                </form>
                @endif
                <span
                    class="text-secondary"
                    >{{ $comment->created_at->format('Y/m/d') }}</span
                >
            </div>
        </div>
        <div class="card-body p-3">{!! nl2br(e($comment->text)) !!}</div>
        @endif
    </li>
    @empty
    <li class="list-group-item">
        <p class="mb-0 text-secondary">コメントはまだありません</p>
    </li>
    @endforelse
    <!-- Comment Post Modal -->
    <div
        class="modal fade form-group row m-auto"
        id="postCommentModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="postCommentModalTitle"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <img
                        src="{{ $storage->url($login_user->profile_image) }}"
                        class="rounded-circle"
                        width="48"
                        height="48"
                    />
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form
                    method="POST"
                    action="{{ route('comments.store') }}"
                    id="commentPost"
                >
                    <div class="modal-body py-0">
                        @csrf
                        <input
                            type="hidden"
                            name="review_id"
                            value="{{ $review->id }}"
                        />
                        <textarea
                            class="
                                form-control
                                @error('text')
                                is-invalid
                                @enderror
                            "
                            name="text"
                            id="textarea"
                            required
                            autocomplete="text"
                            rows="6"
                            autofocus
                            onkeyup="checkTextLength()"
                            >{{ old("text") }}</textarea
                        >
                        @error('text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{
                                "コメントは200字まで投稿可能です"
                            }}</strong>
                        </span>
                        @enderror
                        <div class="text-right">
                            <p id="currentLength">0 / 200文字</p>
                        </div>
                    </div>
                    {{-- 投稿＆キャンセルボタン --}}
                    <div class="modal-footer border-top-0">
                        <button
                            type="button"
                            data-dismiss="modal"
                            aria-label="Close"
                            class="btn btn-secondary rounded-pill"
                        >
                            キャンセル
                        </button>
                        <button
                            type="submit"
                            id="postButton"
                            class="
                                btn btn-primary
                                rounded-pill
                                ml-4
                                shadow-sm
                                disabled
                            "
                            disabled
                        >
                            投稿する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</ul>
<div class="text-right mb-5">
    <button
        type="button"
        class="btn btn-primary rounded-pill mt-3 justify-content-end"
        data-toggle="modal"
        data-target="#postCommentModal"
    >
        コメントを投稿する
    </button>
</div>
