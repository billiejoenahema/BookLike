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
                    <li>著者：{{ $review->author }}</li>
                    <li>出版社：{{ $review->manufacturer }}</li>
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

    <div class="card-footer d-flex bg-white">
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
        <div class="btn">
            @if ($review->user->id === $login_user->id)
            <a href="{{ url('reviews/' .$review->id .'/edit') }}" title="投稿を編集">
                <i class="fas fa-pen text-blog"></i>
            </a>
            @endif
        </div>

        <!-- コメントボタン -->
        <div class="d-flex align-items-center ml-3">
            <a href="{{ url('reviews/' .$review->id) }}" title="コメントを投稿"><i
                    class="far fa-comment fa-fw text-blog"></i></a>
            <p class="mb-0 text-secondary">{{ count($review->comments) }}</p>
        </div>

        <!-- いいねボタン -->
        <div class="d-flex align-items-center ml-4">
            @if (!in_array($login_user->id, array_column($review->favorites->toArray(), 'user_id'), TRUE))
            <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                @csrf
                <input type="hidden" name="review_id" value="{{ $review->id }}">
                <button type="submit" class="btn p-0 border-0 text-blog" title="いいね"><i
                        class="far fa-heart fa-fw"></i></button>
            </form>
            @else
            <form method="POST"
                action="{{ url('favorites/' .array_column($review->favorites->toArray(), 'id', 'user_id')[$login_user->id]) }}"
                class="mb-0">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn p-0 border-0 text-red" title="いいね"><i
                        class="fas fa-heart fa-fw"></i></button>
            </form>
            @endif
            <p class="mb-0 text-secondary">{{ count($review->favorites) }}</p>
        </div>
    </div>
</div>
<!-- コメント -->
@include('components.comment')
</div>
@include('components.review_delete_confirm')
@endsection
