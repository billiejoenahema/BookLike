@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <form method="GET" action="" class="form-inline my-2 my-lg-0">
        @csrf
        <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
    </form>
        @if (isset($timelines))
            @foreach ($timelines as $timeline)
                <div class="col-md-8 mb-3">
                    <div class="card shadow-sm">
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
                        <div class="card-body">
                            <a href="{{ url('reviews/' .$timeline->id) }}" class="text-reset">{!! nl2br(e($timeline->text)) !!}</a>
                        </div>
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
        {{ $timelines->links() }}
    </div>
</div>
@endsection

