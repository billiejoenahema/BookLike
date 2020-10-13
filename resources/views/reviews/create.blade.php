@extends('layouts.app')

@section('content')
    @include('components.back_button')
    <div class="card shadow-sm">
        <div class="card-header bg-cyan text-white">新規投稿</div>
            <div class="card-body form-group col-md-10 m-auto">
                <div class="py-3 d-flex-column m-0">
                    <!-- 書籍検索フォーム -->
                    <label>投稿したい本のタイトルを検索してください</label>
                    <form method="GET" action="{{ route('search_items') }}" class="form-inline">
                        @csrf
                        <input class="form-control col-9 rounded-pill @error('keyword') is-invalid @enderror"
                        name="keyword"
                        type="search"
                        placeholder="キーワードを入力"
                        aria-label="書籍を検索"
                        required autocomplete="on"
                        autofocus>
                        @error('searchItems')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button class="btn ml-2 search-button" type="submit">
                            <i class="fas fa-search text-teal lead"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
