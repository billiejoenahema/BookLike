@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 justify-content-center m-auto">
            <div class="mb-3">
                <form method="GET" action="{{ route('users.index') }}" class="form-inline my-2 my-lg-0">
                    @csrf
                    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>

            @if($search !== null)
            <div class="mb-3">
                <h2 class="text-center">検索結果 "{{ $search }}"</span></h2>
            </div>
            <div class="mb-3 text-right">
                <a href="{{ url('users') }}">ユーザ一覧</a>
            </div>
            @endif
        </div>
        <div class="row justify-content-center m-auto">
            <div class="col-md-8">
                @foreach ($users as $user)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-haeder p-3 w-100 d-flex">
                            @include('components.user_image')
                            <div class="ml-2 d-flex flex-column">
                                <a href="{{ url('users/' .$user->id) }}" class="text-reset">
                                    <p class="mb-0">{{ $user->name }}</p>
                                    <span class="text-secondary">{{ $user->screen_name }}</span>
                                </a>
                            </div>

                            @if ($login_user->isFollowed($user->id))
                            <div class="px-2">
                                <span class="px-1 bg-secondary text-light">フォローされています</span>
                            </div>
                            @endif

                            <div class="px-2">
                                <p>{{ $user->description }}</p>
                            </div>

                            <div class="d-flex justify-content-end ml-auto">
                                @if ($login_user->isFollowing($user->id))
                                    <form action="{{ route('unfollow', $user->id) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger shadow-sm">フォロー中</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', $user->id) }}" method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-primary shadow-sm">フォローする</button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="my-4 d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection
