@extends('layouts.app')

@section('content')
@include('components.index_toggle')
@include('components.back_button')
<div class="card shadow-sm mb-3">
    <div class="card-header px-3">新規投稿</div>
    <div class="card-body p-3">
        <div class="d-flex flex-column p-0">
            <!-- 選択した書籍情報 -->
            <h6>選択した書籍</h6>
            <div class="card mb-4">
                <div class="d-flex p-2">
                    <div class="d-flex flex-column p-2 mr-2">
                        <img src="{{ $image_url ?? asset('images/NoImage.png') }}" width="100">
                    </div>
                    <div class="col-md-8 d-flex flex-column text-left p-2">
                        <h5>{{ $title }}</h5>
                        <ul class="list-unstyled">
                            <li class="list-item">著者：{{ $author ?? '' }}
                            </li>
                            <li class="list-item">
                                出版社：{{ $manufacturer ?? '' }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- レビュー投稿テキストエリア -->
            <div class="form-group">
                <form method="POST" action="{{ route('reviews.store') }}" id="reviewPost">
                    @csrf
                    <div class="mb-3">
                        <select name="category" id="category">
                            <option value="default">カテゴリーを選択してください</option>
                            <option value="文学">文学</option>
                            <option value="エンターテインメント">エンターテインメント</option>
                            <option value="ミステリー">ミステリー</option>
                            <option value="SF">SF</option>
                            <option value="ホラー">ホラー</option>
                            <option value="ファンタジー">ファンタジー</option>
                            <option value="青春・恋愛">青春・恋愛</option>
                            <option value="歴史・時代">歴史・時代</option>
                            <option value="ノンフィクション">ノンフィクション</option>
                            <option value="ビジネス・経済">ビジネス・経済</option>
                            <option value="コンピュータ・IT">コンピュータ・IT</option>
                            <option value="コミック">コミック</option>
                            <option value="ライトノベル">ライトノベル</option>
                            <option value="その他">その他</option>
                        </select>
                    </div>
                    <div class="col-12 p-0">
                        <label>お気に入りの理由を教えてください</label>
                        <textarea id="textarea" class="form-control @error('text') is-invalid @enderror" name="text"
                            required autocomplete="text" rows="8" autofocus
                            onkeyup="checkTextLength()">{{ old('text') ? : '' }}</textarea>
                        @error('text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ '800文字以内で入力してください' }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="hidden" name="asin" id="asin" value="{{ $asin }}">
                    <input type="hidden" name="page_url" id="page_url" value="{{ $page_url }}">
                    <input type="hidden" name="title" id="title" value="{{ $title }}">
                    <input type="hidden" name="author" id="author" value="{{ $author ?? '不明' }}">
                    <input type="hidden" name="manufacturer" id="manufacturer" value="{{ $manufacturer ?? '不明' }}">
                    <input type="hidden" name="image_url" id="image_url"
                        value="{{ $image_url ?? asset('images/NoImage.png') }}">
                    <div class="form-group row mb-0">
                        <div class="col-12 text-right">
                            <p id="currentLength">0 / 800文字</p>
                            <button id="postButton" type="button" onclick="categorySelectValidate()" disabled
                                class="btn btn-primary rounded-pill shadow-sm disabled">投稿する</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
