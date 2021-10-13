<div
    class="modal fade"
    id="newPostModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="newPostModalTitle"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div
                class="
                    modal-header
                    border-bottom-0
                    bg-gradient-seaGreen
                    text-white
                "
            >
                新規投稿
            </div>
            <div class="modal-body d-flex justify-content-center py-4">
                <div class="d-flex-column m-auto">
                    <!-- 書籍検索フォーム -->
                    <label>投稿したい本のタイトルを検索してください</label>
                    <form
                        method="GET"
                        action="{{ route('search_items') }}"
                        class="form-inline"
                    >
                        @csrf
                        <input
                            class="
                                form-control
                                col-10
                                rounded-pill
                                @error('keyword')
                                is-invalid
                                @enderror
                            "
                            name="keyword"
                            type="search"
                            placeholder="キーワードを入力"
                            aria-label="書籍を検索"
                            required
                            autocomplete="on"
                            autofocus
                        />
                        @error('searchItems')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button class="btn search-button" type="submit">
                            <i class="fas fa-search text-teal lead"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
