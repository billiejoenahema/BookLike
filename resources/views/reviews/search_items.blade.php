@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <button type="button" onclick="history.back()" class="btn">
                <i class="fas fa-chevron-left"></i> 戻る
            </button>
            <div class="card shadow-sm">
                <div class="card-header">検索結果一覧</div>

                <div class="card-body m-auto">
                    <div class="form-group mb-3">
                        <span>キーワードを変えて再検索</span>
                        <!-- 書籍検索フォーム -->
                        <div class="d-flex flex-row justify-content-between col-12 mb-5 p-0">
                            <div class="col-8 p-0">
                                <form method="GET" action="{{ route('search_items') }}" class="form-inline">
                                    @csrf
                                    <input class="form-control col-9 @error('keyword') is-invalid @enderror"
                                    name="keyword"
                                    type="search"
                                    value="{{ $keyword }}"
                                    aria-label="書籍を再検索"
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
                    <!-- 検索結果一覧表示 -->
                    <!-- 決定ボタン -->
                    <form method="GET" action="{{ route('reviews.posts') }}">
                        <input
                            id="asin"
                            type="hidden"
                            name="asin"
                            value="">
                        <div class="mb-3">
                            <button
                                class="btn btn-success disabled rounded-pill"
                                id="confirmButton"
                                type="submit"
                                disabled
                                >確定</button>
                        </div>
                    </form>
                    @if ($search_items == null)
                        <div>「キーワード」に該当する書籍は見つかりませんでした</div>
                    @else
                        <div class="overflow-auto" style="height: 70vw; max-height: 400px;">
                        @foreach ($search_items as $search_item)
                        <!-- 検索結果をforeachでまわす -->
                            <div class="card flex-row p-2 mb-2 search-item btn text-left" onClick="selectItem(this)" id="{{ $search_item->ASIN }}">
                                <div class="col-sm-3">
                                    <img class="m-auto" src="{{ $search_item->Images->Primary->Large->URL ?? asset('storage/images/NoImage.png') }}" width="80">
                                </div>
                                <div class="col-sm-9" >
                                    <h5>{{ $search_item->ItemInfo->Title->DisplayValue ?? '' }}</h5>
                                    <ul class="list-unstyled">
                                        <li class="list-item">{{ $search_item->ItemInfo->ByLineInfo->Contributors[0]->Name ?? '' }}</li>
                                        <li class="list-item">{{ $search_item->ASIN }}</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/js/selectItem.js') }}"></script>

@endsection
