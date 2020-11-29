@extends('layouts.app')

@section('content')
@include('components.back_button')
<div class="card shadow-sm">
    <div class="card-haeder p-3 w-100 d-flex">
        @include('components.user_image', ['user' => $review->user])
        <div class="ml-2 d-flex flex-column">
            <p class="mb-0">{{ $review->user->name }}</p>
            <span class="text-secondary">{{ $review->user->screen_name }}</span>
        </div>
        <div class="d-flex justify-content-end flex-grow-1">
            <p class="mb-0 text-secondary">{{ $review->created_at->format('Y-m-d') }}</p>
        </div>
    </div>
    <div class="card-body border-top">
        <div class="d-flex border-bottom">
            <div class="mb-3 py-2 pr-4">
                <img src="{{ $review->image_url }}" width="100">
            </div>
            <div class="col-md-8 d-flex flex-column text-left py-2 px-0">
                <h5 class="mb-3">{{ $review->title }}</h5>
                <ul class="list-unstyled">
                    <li>著者：<a href="/reviews?search={{ $review->author }}&value=author">{{ $review->author }}</a></li>
                    <li>出版社：<a
                            href="/reviews?search={{ $review->manufacturer }}&value=manufacturer">{{ $review->manufacturer }}</a>
                    </li>
                    <li>カテゴリー：{{ $review->category }}</li>
                    <li><a href="{{ $review->page_url }} " target="_blank" rel="noopener" data-toggle="tooltip"
                            data-placement="top" title="Amazonサイトへ移動"><i class="fab fa-amazon"></i> Amazon</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-3">
            {!! nl2br(e($review->text)) !!}
        </div>
    </div>

    <div class="card-footer d-flex bg-white align-items-center">
        <!-- 投稿削除ボタン -->
        <div class="btn flex-grow-1 text-left px-0">
            @if ($review->user->id === $login_user->id)
            <a href="#" role="button" data-toggle="modal" data-target="#deleteReview" title="投稿を削除"
                class="text-secondary mb-0 d-block h5">
                <i class="fas fa-trash"></i>
            </a>
            @endif
        </div>

        <!-- 編集ボタン -->
        <div class="btn mr-2">
            @if ($review->user->id === $login_user->id)
            <a href="{{ url('reviews/' .$review->id .'/edit') }}" title="投稿を編集">
                <i class="fas fa-pen fa-fw text-blog"></i>
            </a>
            @endif
        </div>

        <!-- コメントボタン -->
        <div class="d-inline-flex align-items-center mr-3">
            <a href="{{ url('reviews/' .$review->id) }}" title="コメントを投稿"><i
                    class="far fa-comment fa-fw text-blog"></i></a>
            <p class="mb-0 text-secondary">{{ count($review->comments) }}</p>
        </div>

        <!-- いいねボタン -->
        <div id="reviewShowFavoriteButton" class="d-inline-flex align-items-center mr-3"></div>
    </div>
</div>
<!-- コメント -->
@include('components.comment')
@include('components.review_delete_confirm')
@endsection
