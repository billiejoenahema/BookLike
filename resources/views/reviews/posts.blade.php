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
                        <div class="d-flex mb-3">
                            @include('components.user_image', ['user' => $login_user])
                            <div class="col-4">
                                <p class="m-0">{{ $login_user->name }}</p>
                                <p class="m-0">{{ $login_user->screen_name }}</p>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 p-3 d-flex-column">
                                <div>
                                    <!-- 書籍検索フォーム -->
                                    <div class="mb-3">
                                        <label>書籍を変更する</label>
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

                                    <!-- 選択した書籍情報 -->
                                    <div>
                                        <ul class="list-unstyled">
                                            <li><img src="{{ $image_url ?? '' }}"></li>
                                            <li>タイトル：{{ $title ?? '' }}</li>
                                            <li>著者：{{ $name ?? '' }}</li>
                                            <li>ASIN：{{ $asin ?? '' }}</li>
                                        </ul>
                                    </div>

                                    <!-- レビュー投稿テキストエリア -->
                                    <div>
                                        <form method="POST" action="{{ route('reviews.store') }}">
                                            @csrf
                                                <div class="col-12 p-0">
                                                <label>おすすめの理由</label>
                                                    <textarea class="form-control @error('text') is-invalid @enderror"
                                                    name="text"
                                                    required
                                                    autocomplete="text"
                                                    rows="4"
                                                    ></textarea>
                                                    @error('text')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-12 text-right">
                                                    <p class="mb-4 text-danger">200文字以内</p>
                                                    <button type="input" class="btn btn-primary shadow-sm">
                                                        投稿する
                                                    </button>
                                                </div>
                                            </div>
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
