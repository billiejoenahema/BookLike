@extends('layouts.app')

@section('content')
@include('components.back_button')
<div class="card shadow-sm mb-3">
    <div class="card-header">新規投稿</div>
    <div class="card-body">
        <div class="d-flex flex-column p-0">
            <!-- 選択した書籍情報 -->
            <h6>選択した書籍</h6>
            <div class="card mb-4">
                <div class="d-flex p-2">
                    <div class="d-flex flex-column p-2 mr-2">
                        <img src="{{ $get_item->Images->Primary->Large->URL ?? asset('images/NoImage.png') }}"
                            width="100">
                    </div>
                    <div class="col-md-8 d-flex flex-column text-left p-2">
                        <h5>{{ $get_item->ItemInfo->Title->DisplayValue }}</h5>
                        <ul class="list-unstyled">
                            <li class="list-item">著者：{{ $get_item->ItemInfo->ByLineInfo->Contributors[0]->Name ?? '' }}
                            </li>
                            <li class="list-item">
                                出版社：{{ $get_item->ItemInfo->ByLineInfo->Manufacturer->DisplayValue ?? '' }}</li>
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
                        <label>おすすめの理由を教えてください</label>
                        <textarea class="form-control @error('text') is-invalid @enderror" name="text" required
                            autocomplete="text" rows="8" autofocus
                            onkeyup="checkTextLength(value)">{{ old('text') ? : '' }}</textarea>
                        @error('text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ '800文字以内で入力してください' }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="hidden" name="asin" id="asin" value="{{ $get_item->ASIN }}">
                    <input type="hidden" name="page_url" id="page_url" value="{{ $get_item->DetailPageURL }}">
                    <input type="hidden" name="title" id="title" value="{{ $get_item->ItemInfo->Title->DisplayValue }}">
                    <input type="hidden" name="author" id="author"
                        value="{{ $get_item->ItemInfo->ByLineInfo->Contributors[0]->Name ?? '不明' }}">
                    <input type="hidden" name="manufacturer" id="manufacturer"
                        value="{{ $get_item->ItemInfo->ByLineInfo->Manufacturer->DisplayValue ?? '不明' }}">
                    <input type="hidden" name="image_url" id="image_url"
                        value="{{ $get_item->Images->Primary->Large->URL ?? asset('images/NoImage.png') }}">
                    <div class="form-group row mb-0">
                        <div class="col-12 text-right">
                            <p id="textLength">0 / 800文字</p>
                            <button type="button" onclick="categorySelectValidate()"
                                class="btn btn-primary rounded-pill shadow-sm">投稿する</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
