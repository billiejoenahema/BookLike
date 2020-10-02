@extends('layouts.app')

@section('content')
<div class="container px-0">
    <div class="col-md-10 col-lg-8 mb-3 m-auto">
        <div class="card shadow-sm mb-5">
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
                                <li class="list-item"><a href="#"><i class="fab fa-amazon"></i> Amazon link</a></li>
                                <li class="list-item">{{ $review->asin }}</li>
                            </ul>
                        </div>
                    </div>
                <div>
                    {!! nl2br(e($review->text)) !!}
                </div>
            </div>

            <div class="card-footer d-flex bg-white">
                <!-- 投稿削除ボタン -->
                <div class="btn flex-grow-1 text-left">
                @if ($review->user->id === $login_user->id)
                    <a href="#"
                        role="button"
                        data-toggle="modal"
                        data-target="#deleteReview"
                        class="text-secondary mb-0 d-block h5">
                        <i class="fas fa-trash"></i>
                    </a>
                @endif
                </div>

                <!-- 編集ボタン -->
                <div class="btn">
                @if ($review->user->id === $login_user->id)
                    <a href="{{ url('reviews/' .$review->id .'/edit') }}"><i class="fas fa-edit"></i></a>
                @endif
                </div>

                <!-- コメントボタン -->
                <div class="d-flex align-items-center ml-3">
                    <a href="{{ url('reviews/' .$review->id) }}"><i class="far fa-comment fa-fw"></i></a>
                    <p class="mb-0 text-secondary">{{ count($review->comments) }}</p>
                </div>

                <!-- いいねボタン -->
                <div class="d-flex align-items-center ml-4">
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
        <!-- コメント -->
        @include('components.comment')
    </div>

    <!-- Confirm Modal -->
    <div class="modal fade" id="deleteReview" tabindex="-1" role="dialog" aria-labelledby="deleteReviewTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title font-weight-bold" id="delteReviewLongTitle">投稿を削除しますか？</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                    <form method="POST" action="{{ route('reviews.destroy', $review) }}">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
