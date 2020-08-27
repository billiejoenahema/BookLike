@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- フラッシュメッセージ -->
        @if (session('login_message'))
            <div class="login_message col-md-8 mb-3 text-center text-dark rounded">
                {{ session('login_message') }}
            </div>
        @endif
        <div class="col-md-8 mb-3 text-right">
            <a href="{{ url('users') }}">ユーザ一覧</a>
        </div>
        @if (isset($timelines))
            @foreach ($timelines as $timeline)
                <div class="col-md-8 mb-3">
                    <div class="card shadow-sm">

                        <!-- ユーザー情報 -->
                        <div class="card-haeder p-3 w-100 d-flex">
                            @include('components.user_image', ['user' => $timeline->user])
                            <div class="ml-2 d-flex flex-column">
                                <a href="{{ url('users/' .$timeline->user->id) }}" class="text-reset">
                                    <p class="mb-0">{{ $timeline->user->name }}</p>
                                    <span class="text-secondary">{{ $timeline->user->screen_name }}</span>
                                </a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>

                        <!-- 書籍情報 -->
                        <div class="card-body border-top border-bottom">
                            <div class="d-flex p-2">
                                <div class="d-flex flex-column mb-3 p-2">
                                    <img src="{{ $timeline->image_url }}" width="80" class="shadow-sm">
                                </div>
                                <div class="d-flex flex-column text-left p-2" >
                                    <a href="{{ url('reviews/' .$timeline->id) }}" class="h5 text-reset">{{ $timeline->title }}</a>
                                </div>
                            </div>
                        </div>

                        <!-- おすすめの理由 -->
                        <div class="card-body">
                            <a href="{{ url('reviews/' .$timeline->id) }}" class="d-block text-reset">{{ \Illuminate\Support\Str::limit($timeline->text, 200, '・・・続きを読む') }}</a>
                        </div>

                        <!-- 編集＆削除・コメント・いいね -->
                        <div class="card-footer py-1 d-flex justify-content-end bg-white">
                            @if ($timeline->user->id === Auth::user()->id)
                                <div class="dropdown mr-3 d-flex align-items-center">
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <form method="POST" action="{{ url('reviews/' .$timeline->id) }}" class="mb-0">
                                            @csrf
                                            @method('DELETE')

                                            <a href="{{ url('reviews/' .$timeline->id .'/edit') }}" class="dropdown-item">編集</a>
                                            <button type="submit" class="dropdown-item del-btn">削除</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            <div class="mr-3 d-flex align-items-center">
                                <a href="{{ url('reviews/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                <p class="mb-0 text-secondary">{{ count($timeline->comments) }}</p>
                            </div>
                            <div class="mr-3 d-flex align-items-center">
                            @if (!in_array($login_user->id, array_column($timeline->favorites->toArray(), 'user_id'), TRUE))
                                    <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                                        @csrf
                                        <input type="hidden" name="review_id" value="{{ $timeline->id }}">
                                        <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ url('favorites/' .array_column($timeline->favorites->toArray(), 'id', 'user_id')[$login_user->id]) }}" class="mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
                                    </form>
                                @endif
                                <p class="mb-0 text-secondary">{{ count($timeline->favorites) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="my-4 d-flex justify-content-center">

    </div>
</div>
@endsection
