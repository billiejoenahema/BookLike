@extends('layouts.app')

@section('content')
@include('components.index_toggle')
@include('components.back_button')
<div class="card shadow-sm">
    <div class="card-header p-3">検索結果一覧</div>
    <div class="card-body p-3">
        <div class="form-group mb-3">
            <span>キーワードを変えて再検索</span>
            <!-- 書籍検索フォーム -->
            <div class="d-flex flex-row p-0">
                <div class="col-sm-8 p-0">
                    <form method="GET" action="{{ route('search_items') }}" class="form-inline">
                        @csrf
                        <input class="form-control rounded-pill col-9 @error('keyword') is-invalid @enderror"
                            name="keyword" type="search" value="{{ $keyword }}" aria-label="書籍を再検索" required
                            autocomplete="on">
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
        @if (session('error'))
        <p class="text-danger">{{ session('error') }}</p>
        @endif
        <!-- 検索結果一覧表示 -->
        <!-- 決定ボタン -->
        <form method="GET" action="{{ route('reviews.posts') }}">
            @csrf
            <input id="asin" type="hidden" name="asin" value="">
            <button class="btn btn-primary disabled rounded-pill col-3 shadow-sm" id="confirmButton" type="submit"
                disabled>確定</button>
        </form>
        <div class="mt-3">
            <p class="mb-1">投稿する本を選んでください</p>
            @if (empty($search_items))
            <div>「キーワード」に該当する書籍は見つかりませんでした</div>
            @else
            <div class="overflow-auto" style="height: 70vw; max-height: 400px;">
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
                                {{ $search_item->ItemInfo->ByLineInfo->Contributors[0]->Name ?? '' }}
                            </li>
                            <li class="list-item">
                                {{ $search_item->ItemInfo->ByLineInfo->Manufacturer->DisplayValue ?? '' }}
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
