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
                                <!-- 選択した書籍情報 -->
                                <div class="card flex-row p-2 mb-4 btn text-left">
                                    <div class="col-sm-4">
                                        <img class="m-auto" src="{{ $get_item->Images->Primary->Medium->URL }}" width="100">
                                    </div>
                                    <div class="col-sm-8" >
                                        <h5>{{ $get_item->ItemInfo->Title->DisplayValue }}</h5>
                                        <ul class="list-unstyled">
                                            <li class="list-item">{{ $get_item->ItemInfo->ByLineInfo->Contributors[0]->Name }}</li>
                                            <li class="list-item">{{ $get_item->ASIN }}</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- レビュー投稿テキストエリア -->
                                <div class="form-group">
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
                                                <p class="mb-4 text-danger">400文字以内</p>
                                                <input type="button" value="送信" class="btn btn-primary shadow-sm">
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
@endsection
