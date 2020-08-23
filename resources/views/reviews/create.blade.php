@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('components.cross_button')
            <div class="card shadow-sm">
                <div class="card-header">新規投稿</div>
                <div class="card-body">
                    <div class="col-lg-10 m-auto">
                        <div class="form-group row mb-0">
                            <div class="col-md-12 p-3 d-flex-column">
                                <div>
                                    <!-- 書籍検索フォーム -->
                                    <div class="mb-3">
                                        <label>投稿したい本のタイトルを検索してください</label>
                                        <form method="GET" action="{{ route('search_items') }}" class="form-inline">
                                            @csrf
                                            <input class="form-control col-9 @error('keyword') is-invalid @enderror"
                                            name="keyword"
                                            type="search"
                                            placeholder="キーワードを入力"
                                            aria-label="書籍を検索"
                                            required autocomplete="on">
                                            @error('searchItems')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <button class="btn btn-outline-success ml-2" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
