@extends('layouts.app')

@section('content')
@include('components.index_toggle')
@include('components.back_button')
<div class="card shadow-sm mb-3">
    <div class="card-header px-3">新規投稿</div>
    <div class="card-body p-3">
        <form method="POST" action="{{ route('reviews.store') }}" id="reviewPost">
            @csrf
            <div class="d-flex flex-column p-0">
                <!-- 選択した書籍情報 -->
                <h6>選択した書籍</h6>
                <div class="card mb-3">
                    <div class="d-flex p-2">
                        <div class="d-flex flex-column p-2 mr-2">
                            <img src="{{ $image_url ?? asset('images/NoImage.png') }}" width="100">
                        </div>
                        <div class="col-md-8 d-flex flex-column text-left p-2">
                            <h5>{{ $title }}</h5>
                            <ul class="list-unstyled">
                                <li class="list-item">著者：{{ $author ?? '不明' }}
                                </li>
                                <li class="list-item">
                                    出版社：{{ $manufacturer ?? '不明' }}</li>
                                <li class="list-item">評価：<label for="ratings" class="ratings-value">3</label>
                                    <div class="d-flex">
                                        <div class="flex-row text-mango lead border py-1 px-3" id="ratings"
                                            data-ratings="3" title="クリックして選択">
                                            <span><i id="1" onclick="changeStars(this)"
                                                    class="edit-star far fa-star"></i></span>
                                            <span><i id="2" onclick="changeStars(this)"
                                                    class="edit-star far fa-star"></i></span>
                                            <span><i id="3" onclick="changeStars(this)"
                                                    class="edit-star far fa-star"></i></span>
                                            <span><i id="4" onclick="changeStars(this)"
                                                    class="edit-star far fa-star"></i></span>
                                            <span><i id="5" onclick="changeStars(this)"
                                                    class="edit-star far fa-star"></i></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            {{-- ネタバレありなし選択 --}}
                            <div class="d-flex-column">
                                <label for="spoiler" class="d-flex">ネタバレ：</label>
                                <select name="spoiler" class="form-controll p-1">
                                    <option value="0" selected>ネタバレなし</option>
                                    <option value="1">ネタバレあり</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{-- カテゴリー選択 --}}
                    <div class="mb-3 flex-column flex-wrap">
                        <select name="category" id="categorySelector" onchange="changeCategory()">
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
                        <span class="d-block d-sm-inline pl-1 text-danger" id="categoryAlert">カテゴリーを選択してください</span>
                    </div>
                    {{-- レビュー投稿 --}}
                    <div class="col-12 p-0">
                        <label class="d-inline text-blog font-weight-bold">レビュー</label>
                        <textarea id="textarea" class="form-control @error('text') is-invalid @enderror" name="text"
                            autocomplete="text" rows="8" onkeyup="checkTextLength()">{{ old('text') ? : '' }}</textarea>
                        @error('text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ '800文字以内で入力してください' }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="hidden" name="asin" id="asin" value="{{ $asin }}">
                    <input type="hidden" name="page_url" id="page_url" value="{{ $page_url ?? '不明' }}">
                    <input type="hidden" name="title" id="title" value="{{ $title ?? '不明' }}">
                    <input type="hidden" name="author" id="author" value="{{ $author ?? '不明' }}">
                    <input type="hidden" name="manufacturer" id="manufacturer" value="{{ $manufacturer ?? '不明' }}">
                    <input type="hidden" name="image_url" id="image_url"
                        value="{{ $image_url ?? asset('images/NoImage.png') }}">
                    <input type="hidden" name="ratings" id="inputRatings" value="3">

                    <div class="form-group row mb-0">
                        <div class="col-12 text-right">
                            <p id="currentLength">0 / 800文字</p>
                            <button id="postButton" type="button" onclick="categorySelectValidate()"
                                class="btn btn-primary rounded-pill shadow-sm disabled">投稿する</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
</div>
@endsection
