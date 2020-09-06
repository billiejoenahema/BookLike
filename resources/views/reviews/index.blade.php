@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3 text-right">
            <a href="{{ url('users') }}">ユーザ一覧</a>
        </div>
        <div class="col-md-8">
            <!-- React-tabs -->
            <div id="reviewsTab"></div>

            <h2 class="my-5">--------ここからBlade--------</h2>
            @if (isset($timelines))
            @foreach ($timelines as $timeline)
                    <div class="card shadow-sm mb-3">
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
                                <p class="mb-0 text-secondary">{{ $timeline->created_at->format('Y-m-d') }}</p>
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
                        @if ($timeline->user->id === $login_user->id)
                            <div class="mr-3 d-flex align-items-center">
                                <form method="POST" action="{{ url('reviews/' .$timeline->id) }}" class="mb-0">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ url('reviews/' .$timeline->id .'/edit') }}"><i class="fas fa-ellipsis-v fa-fw"></i></a>
                                </form>
                            </div>
                        @endif
                        <!-- コメントボタン -->
                            <div class="mr-3 d-flex align-items-center">
                                <a href="{{ url('reviews/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                <p class="mb-0 text-secondary">{{ count($timeline->comments) }}</p>
                            </div>
                        <!-- いいねボタン -->
                            <div class="mr-3 d-flex align-items-center">
                            @if (!in_array($login_user->id, array_column($timeline->favorites->toArray(), 'user_id'), TRUE))
                                <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                                    @csrf
                                    <input type="hidden" name="review_id" value="{{ $timeline->id }}">
                                    <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                                </form>
                            @else
                                <form method="POST"
                                    action="{{ url('favorites/' .array_column($timeline->favorites->toArray(), 'id', 'user_id')[$login_user->id]) }}"
                                    class="mb-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
                                </form>
                            @endif
                                <p class="mb-0 text-secondary">{{ count($timeline->favorites) }}</p>
                            </div>
                        </div>
                    </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
