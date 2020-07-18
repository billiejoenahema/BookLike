@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-haeder p-3 w-100 d-flex">
                    @if($review->user->profile_image == null)
                        <img src="{{ asset('storage/profile_image/Default_User_Icon.jpeg') }}" class="rounded-circle" width="50" height="50">
                    @else
                        <img src="{{ asset('storage/profile_image/'.$review->user->profile_image) }}" class="rounded-circle" width="50" height="50">
                    @endif
                    <div class="ml-2 d-flex flex-column">
                        <p class="mb-0">{{ $review->user->name }}</p>
                        <a href="{{ url('users/' .$review->user->id) }}" class="text-secondary">{{ $review->user->screen_name }}</a>
                    </div>
                    <div class="d-flex justify-content-end flex-grow-1">
                        <p class="mb-0 text-secondary">{{ $review->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
                <div class="card-body">
                    {!! nl2br(e($review->text)) !!}
                </div>
                <div class="card-footer py-1 d-flex justify-content-end bg-white">
                    @if ($review->user->id === Auth::user()->id)
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

    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <ul class="list-group">
                @forelse ($comments as $comment)
                    <li class="list-group-item">
                        <div class="py-3 w-100 d-flex">
                            @if($comment->user->profile_image == null)
                                <img src="{{ asset('storage/profile_image/Default_User_Icon.jpeg') }}" class="rounded-circle" width="50" height="50">
                            @else
                                <img src="{{ asset('storage/profile_image/'.$comment->user->profile_image) }}" class="rounded-circle" width="50" height="50">
                            @endif
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $comment->user->name }}</p>
                                <a href="{{ url('users/' .$comment->user->id) }}" class="text-secondary">{{ $comment->user->screen_name }}</a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="py-3">
                            {!! nl2br(e($comment->text)) !!}
                        </div>
                    </li>
                @empty
                    <li class="list-group-item">
                        <p class="mb-0 text-secondary">コメントはまだありません。</p>
                    </li>
                @endforelse
                <li class="list-group-item">
                    <div class="py-3">
                        <form method="POST" action="{{ route('comments.store') }}">
                            @csrf

                            <div class="form-group row mb-0">
                                <div class="col-md-12 p-3 w-100 d-flex">
                                @if($login_user->profile_image == null)
                                    <img src="{{ asset('storage/profile_image/Default_User_Icon.jpeg') }}" class="rounded-circle" width="50" height="50">
                                @else
                                    <img src="{{ asset('storage/profile_image/'.$login_user->profile_image) }}" class="rounded-circle" width="50" height="50">
                                @endif
                                <div class="ml-2 d-flex flex-column">
                                        <p class="mb-0">{{ $login_user->name }}</p>
                                        <a href="{{ url('users/' .$login_user->id) }}" class="text-secondary">{{ $review->user->screen_name }}</a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="review_id" value="{{ $review->id }}">
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
                                    <button type="submit" class="btn btn-primary shadow-sm">
                                        投稿する
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
