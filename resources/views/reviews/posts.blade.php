@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <button type="button" onclick="history.back()" class="btn">
                <i class="fas fa-chevron-left"></i> 戻る
            </button>
            <div class="card shadow-sm">
                <div class="card-header">新規投稿</div>
                <div class="card-body">
                    <div class="m-auto">
                        <div class="d-flex flex-column col-12 p-0">
                            <!-- 選択した書籍情報 -->
                            <div class="card mb-5">
                                <div class="d-sm-flex p-2">
                                    <div class="d-flex flex-column mb-3 p-2">
                                        <img src="{{ $get_item->Images->Primary->Large->URL }}" width="100">
                                    </div>
                                    <div class="d-flex flex-column text-left p-2" >
                                        <h5>{{ $get_item->ItemInfo->Title->DisplayValue }}</h5>
                                        <ul class="list-unstyled">
                                            <li class="list-item">{{ $get_item->ItemInfo->ByLineInfo->Contributors[0]->Name }}</li>
                                            <li class="list-item">{{ $get_item->ASIN }}</li>
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
                                            rows="6"
                                            ></textarea>
                                            @error('text')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <input type="text" name="asin" id="asin" value="{{ $get_item->ASIN }}">
                                    <input type="text" name="title" id="title" value="{{ $get_item->ItemInfo->Title->DisplayValue }}">
                                    <input type="text" name="image_url" id="image_url" value="{{ $get_item->Images->Primary->Large->URL }}">
                                    <div class="form-group row mb-0">
                                        <div class="col-12 text-right">
                                            <p class="mb-3 text-danger">400文字以内</p>
                                            <button type="submit" class="btn btn-primary shadow-sm">投稿する</button>
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
@endsection
