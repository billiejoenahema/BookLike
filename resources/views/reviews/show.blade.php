@extends('layouts.app')

@section('content')
@include('components.index_toggle')
@include('components.back_button')
<h6 class="mt-4">レビュー詳細</h6>
<div class="card shadow-sm">
    <div class="card-haeder p-3 w-100 d-flex">
        @include('components.user_image', ['user' => $review->user])
        <div class="ml-2 d-flex flex-column">
            <p class="mb-0">{{ $review->user->name ?? $review->user->screen_name }}</p>
            <span class="text-secondary">{{ $review->user->screen_name }}</span>
        </div>
        <div class="d-flex justify-content-end flex-grow-1">
            <p class="mb-0 text-secondary">{{ $review->created_at->format('Y-m-d') }}</p>
        </div>
    </div>
    <div class="card-body d-flex border-top border-bottom py-3 px-0 mx-3">
        <div>
            <img src="{{ $review->image_url }}" width="100">
        </div>
        <div class="d-flex flex-column text-left pl-3 px-0">
            <p class="mb-3">{{ $review->title }}</p>
            <ul class="list-unstyled">
                <li>著者：{{ $review->author }}</li>
                <li>出版社：{{ $review->manufacturer }}</li>
                <li>カテゴリー：{{ $review->category }}</li>
                <li><a href="{{ $review->page_url }} " target="_blank" rel="noopener" data-toggle="tooltip"
                        data-placement="top" title="Amazonサイトへ移動"><i class="fab fa-amazon"></i> Amazon</a></li>
            </ul>
        </div>
    </div>
    <div class="card-body p-3">
        {!! nl2br(e($review->text)) !!}
    </div>

    <div class="card-footer border-top-0 pt-0 px-3 d-flex bg-white align-items-center">

        {{-- 投稿編集・削除ボタン --}}
        <div class="flex-grow-1">
            @if ($review->user->id === $login_user->id)
            <a class="text-secondary pt-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuLink">
                <a href="{{ url('reviews/' .$review->id .'/edit') }}" class="dropdown-item text-reset">
                    投稿を編集
                </a>
                <a href="#" class="dropdown-item text-decoration-none text-danger" data-toggle="modal"
                    data-target="#deleteReview" role="button">
                    投稿を削除
                </a>
            </div>
            @endif
        </div>

        <!-- コメントボタン -->
        <div class="btn d-inline-flex align-items-center ml-3">
            <i data-toggle="modal" data-target="#postCommentModal" title="コメントと投稿"
                class="far fa-comment fa-fw text-blog"></i>
            <p class="mb-0 text-secondary">{{ count($review->comments) }}</p>
        </div>

        <!-- いいねボタン -->
        <div id="reviewShowFavoriteButton" class="d-inline-flex align-items-center ml-4 mr-3"></div>
    </div>
</div>
<!-- コメント -->
@include('components.comment')
@include('components.delete_review_confirm')
@endsection
