@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 mb-3">
            <button type="button" onclick="history.back()" class="btn">
                <i class="fas fa-chevron-left"></i> 戻る
            </button>

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
                        <div class="d-sm-flex p-2 border-bottom">
                            <div class="d-flex flex-column mb-3 p-2">
                                <a href="{{ $item_url }}">
                                    <img src="{{ $review->image_url }}" width="160">
                                </a>
                            </div>
                            <div class="d-flex flex-column text-left p-2" >
                                <h5>{{ $review->title }}</h5>
                                <ul class="list-unstyled">
                                    <li class="list-item">著者名</li>
                                    <li class="list-item">Amazon-link</li>
                                    <li class="list-item">{{ $review->asin }}</li>
                                </ul>
                            </div>
                        </div>
                    <div>
                        {!! nl2br(e($review->text)) !!}
                    </div>
                </div>
                <div class="card-footer py-1 d-flex justify-content-end bg-white">
                    @if ($review->user->id === $login_user->id)
                    <div class="dropdown mr-3 d-flex align-items-center">
                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-fw"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form method="POST" action="{{ url('reviews/' .$review->id) }}" class="mb-0">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ url('reviews/' .$review->id .'/edit') }}" class="dropdown-item">編集</a>
                                    <button type="submit" class="dropdown-item del-btn">削除</button>
                                </form>
                            </div>
                        </div>
                    @endif
                    <div class="mr-3 d-flex align-items-center">
                        <a href="{{ url('reviews/' .$review->id) }}"><i class="far fa-comment fa-fw"></i></a>
                        <p class="mb-0 text-secondary">{{ count($review->comments) }}</p>
                    </div>

                    <div class="d-flex align-items-center">
                    @if (!in_array($login_user->id, array_column($review->favorites->toArray(), 'user_id'), TRUE))
                            <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                                @csrf
                                <input type="hidden" name="review_id" value="{{ $review->id }}">
                                <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                            </form>
                    @else
                        <form method="POST" action="{{ url('favorites/' .array_column($review->favorites->toArray(), 'id', 'user_id')[$login_user->id]) }}" class="mb-0">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
                        </form>
                    @endif
                    <p class="mb-0 text-secondary">{{ count($review->favorites) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.comment')
</div>
@endsection
