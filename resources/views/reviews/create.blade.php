@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('components.cross_button')
            <div class="card shadow-sm">
                <div class="card-header">新規投稿</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('reviews.store') }}">
                        @csrf

                        <div class="form-group row mb-0">
                            <div class="col-md-12 p-3 w-100 d-flex">
                                @include('components.user_image', ['user' => $login_user])
                                <div class="ml-2 d-flex flex-column">
                                    <p class="mb-0">{{ $login_user->name }}</p>
                                    {{ $login_user->screen_name }}
                                </div>
                            </div>
                            <!-- trigger modal -->
                            <div id="searchItems" class="col-12 d-flex"></div>
                            <div class="col-md-12">
                                <h5>おすすめポイント</h5>
                                <textarea class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="4">{{ old('text') }}</textarea>

                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <p class="mb-4 text-danger">200文字以内</p>
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
<!-- Modal SearchItems-->
<div class="modal fade" id="searchItems" tabindex="-1" role="dialog" aria-labelledby="searchItemsTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="searchResultTitle">検索結果</h5>
                <!-- 検索結果をforeachでまわす -->
                <div class="card">
                    <h4>{{ $title ?? 'title' }}</h4>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                <button type="button" class="btn btn-primary">決定</button>
            </div>
        </div>
    </div>
</div>
@endsection
