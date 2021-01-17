@extends('layouts.app')

@section('content')
@include('components.index_toggle')
<div class="card shadow-sm mt-3">
    <div class="card-header px-3">検索結果</div>
    <div class="card-body p-3">
        <div class="form-group mb-3">
            <span>キーワードを変えて再検索</span>
            <!-- 書籍検索フォーム -->
            <div class="d-flex flex-row p-0 mt-1">
                <form method="GET" action="{{ route('search_items') }}"
                    class="form-inline d-flex justify-content-between col-sm-8 px-0">
                    @csrf
                    <input class="form-control rounded-pill col-10 @error('keyword') is-invalid @enderror"
                        name="keyword" type="search" value="{{ $keyword }}" aria-label="書籍を再検索" required
                        autocomplete="on">
                    @error('searchItems')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button class="btn search-button" type="submit">
                        <i class="fas fa-search text-teal lead"></i>
                    </button>
                </form>
            </div>
        </div>
        @if (session('error'))
        <p class="text-danger">{{ session('error') }}</p>
        @endif
        <!-- 検索結果一覧表示 -->
        <!-- 決定ボタン -->
        <form method="GET" action="{{ route('reviews.post') }}">
            @csrf
            <input id="asin" type="hidden" name="asin" value="">
            <button class="btn btn-primary disabled rounded-pill col-sm-4 my-1 shadow-sm" id="confirmButton"
                type="submit" disabled>確定</button>
        </form>
        <div class="mt-3">
            @if (empty($search_items))
            <div class="py-3 text-danger">「キーワード」に該当する書籍は見つかりませんでした</div>
            @else
            <p class="mb-1">投稿する本を選んでから確定を押してください</p>
            <div class="overflow-auto search-results">
                <!-- 検索結果をforeachでまわす -->
                @foreach ($search_items as $search_item)
                <div class="card flex-row p-2 mb-2 search-item btn text-left shadow-sm" onClick="selectItem(this)"
                    id="{{ $search_item->ASIN }}">
                    <div>
                        <img class="align-items-start"
                            src="{{ $search_item->Images->Primary->Large->URL ?? asset('images/NoImage.png') }}"
                            width="80">
                    </div>
                    <div class="d-flex flex-column pl-2">
                        <h5>{{ $search_item->ItemInfo->Title->DisplayValue ?? '' }}</h5>
                        <ul class="list-unstyled">
                            <li class="list-item">
                                <span>著者：</span>{{ $search_item->ItemInfo->ByLineInfo->Contributors[0]->Name ?? '' }}
                            </li>
                            <li class="list-item">
                                <span>出版社：</span>{{ $search_item->ItemInfo->ByLineInfo->Manufacturer->DisplayValue ?? '' }}
                            </li>
                            <li class="list-item">
                                <object><a href={{ $search_item->DetailPageURL }} target="_blank" rel="noopener"><i
                                            class="fab fa-amazon"></i> Amazon</a></object>
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
