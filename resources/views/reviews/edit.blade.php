@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <form method="POST" action="{{ route('reviews.destroy', $review) }}" id="delete_{{ $review->id }}">
        @csrf
        @method('DELETE')
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="h5 mb-0">編集</div>
                <a href="#"
                    data-id="{{ $review->id }}"
                    onclick="deletePost(this)"
                    class="text-secondary h5 mb-0 d-block"
                    ><i class="fas fa-trash"></i></a>
            </div>
        </form>
        <div class="card-body">
            <div class="col-md-12 p-3 w-100 d-flex">
                @include('components.user_image', ['user' => $login_user])
                <div class="ml-2 d-flex flex-column">
                    <p class="mb-0">{{ $login_user->name }}</p>
                    <span class="text-secondary">{{ $login_user->screen_name }}</span>
                </div>
            </div>
        <div>
        <div class="border-top">
            <div class="d-sm-flex p-2">
                <div class="d-flex flex-column mb-3 p-2">
                    <a href="{{ $item_url }}">
                        <img src="{{ $review->image_url }}" width="160" class="shadow-sm">
                    </a>
                </div>
                <div class="d-flex flex-column text-left p-2" >
                    <h5>{{ $review->title }}</h5>
                    <ul class="list-unstyled">
                        <li class="list-item">著者名</li>
                        <li class="list-item">{{ $review->asin }}</li>
                    </ul>
                </div>
            </div>
            <form method="POST" action="{{ route('reviews.update', $review) }}">
                @csrf
                @method('PUT')
                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <textarea class="form-control
                        @error('text') is-invalid @enderror"
                        name="text"
                        id="inputtedText"
                        required
                        autocomplete="text"
                        rows="6"
                        onkeyup="checkTextLength(value)"
                        >{{ old('text') ? : $review->text }}</textarea>
                        @error('text')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-12 text-right">
                        <p id="textLength">0 / 400文字</p>
                        <button type="submit" class="btn btn-primary shadow-sm">投稿を編集する</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
