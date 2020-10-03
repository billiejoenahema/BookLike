@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">検索結果一覧</div>
        <div class="card-body">
            <div class="form-group mb-3">
                <span>キーワードを変えて再検索</span>
                <!-- 書籍検索フォーム -->
                <div class="d-flex flex-row p-0">
                    <div class="col-sm-8 p-0">
                        <form method="GET" action="{{ route('search_items') }}" class="form-inline">
                            @csrf
                            <input class="form-control shadow-sm col-9 @error('keyword') is-invalid @enderror"
                            name="keyword"
                            type="search"
                            value="{{ $keyword }}"
                            aria-label="書籍を再検索"
                            required autocomplete="on">
                            @error('searchItems')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <button class="btn btn-outline-teal ml-2 shadow-sm" type="submit">
                                <i class="fas fa-search"></i>
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
                <input
                    id="asin"
                    type="hidden"
                    name="asin"
                    value="">
                <div class="mb-3">
                    <button
                        class="btn btn-primary disabled rounded-pill col-3 shadow-sm"
                        id="confirmButton"
                        type="submit"
                        disabled
                        >確定</button>
                </div>
            </form>
            <div>
            <h5>投稿する本を選んでください</h5>
            @if (empty($search_items))
                <div>「キーワード」に該当する書籍は見つかりませんでした</div>
            @else
                <div class="overflow-auto" style="height: 70vw; max-height: 400px;">
                @foreach ($search_items as $search_item)
                <!-- 検索結果をforeachでまわす -->
                    <div class="card flex-row p-2 mb-2 search-item btn text-left shadow-sm" onClick="selectItem(this)" id="{{ $search_item->ASIN }}">
                        <div class="d-flex">
                            <img class="m-auto" src="{{ $search_item->Images->Primary->Large->URL ?? asset('storage/images/NoImage.png') }}" width="80">
                        </div>
                        <div class="d-flex flex-column pl-2" >
                            <h5>{{ $search_item->ItemInfo->Title->DisplayValue ?? '' }}</h5>
                            <ul class="list-unstyled">
                                <li class="list-item">{{ $search_item->ItemInfo->ByLineInfo->Contributors[0]->Name ?? '' }}</li>
                                <li class="list-item">{{ $search_item->ItemInfo->ByLineInfo->Manufacturer->DisplayValue ?? '' }}</li>
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
