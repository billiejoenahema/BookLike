@extends('layouts.app')

@section('content')
    <button type="button" onclick="history.back()" class="btn">
        <i class="fas fa-chevron-left"></i> 戻る
    </button>
    <div class="card shadow-sm">
        <div class="card-header">新規投稿</div>
        <div class="card-body">
            <div class="d-flex flex-column p-0">
                <!-- 選択した書籍情報 -->
                <h6>選択した書籍</h6>
                <div class="card mb-4">
                    <div class="d-flex flex-wrap p-2">
                        <div class="d-flex flex-column p-2 mr-2">
                            <img src="{{ $get_item->Images->Primary->Large->URL }}" width="100">
                        </div>
                        <div class="col-md-8 d-flex flex-column text-left p-2" >
                            <h5>{{ $get_item->ItemInfo->Title->DisplayValue }}</h5>
                            <ul class="list-unstyled">
                                <li class="list-item">{{ $get_item->ItemInfo->ByLineInfo->Contributors[0]->Name }}</li>
                                <li class="list-item">{{ $get_item->ItemInfo->ByLineInfo->Manufacturer->DisplayValue }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- レビュー投稿テキストエリア -->
                <div class="form-group">
                    <form method="POST" action="{{ route('reviews.store') }}">
                        @csrf
                        <div class="col-12 p-0">
                            <label>おすすめの理由を教えてください</label>
                                <textarea class="form-control @error('text') is-invalid @enderror"
                                name="text"
                                required
                                autocomplete="text"
                                rows="8"
                                autofocus
                                onkeyup="checkTextLength(value)"
                                >{{ old('text') ? : '' }}</textarea>
                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ '400文字以内' }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <input type="hidden" name="asin" id="asin" value="{{ $get_item->ASIN }}">
                        <input type="hidden" name="page_url" id="page_url" value="{{ $get_item->DetailPageURL }}">
                        <input type="hidden" name="title" id="title" value="{{ $get_item->ItemInfo->Title->DisplayValue }}">
                        <input type="hidden" name="author" id="author" value="{{ $get_item->ItemInfo->ByLineInfo->Contributors[0]->Name }}">
                        <input type="hidden" name="manufacturer" id="manufacturer" value="{{ $get_item->ItemInfo->ByLineInfo->Manufacturer->DisplayValue }}">
                        <input type="hidden" name="image_url" id="image_url" value="{{ $get_item->Images->Primary->Large->URL }}">
                        <div class="form-group row mb-0">
                            <div class="col-12 text-right">
                                <p id="textLength">0 / 400文字</p>
                                <button type="submit" class="btn btn-primary shadow-sm">投稿する</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
