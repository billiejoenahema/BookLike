@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3 text-right">
                <a href="{{ url('users') }}">ユーザ一覧</a>
            </div>
            @include('components.user_profile')
            @if (isset($following_users))
                @foreach ($following_users as $following)
                    @if($following->id != $login_user->id && $following->id != $user->id)
                        <div class="col-md-8">
                            <div class="card mb-1">
                                <div class="card-haeder p-3 w-100 d-flex">
                                    @include('components.user_image', ['user' => $following])
                                    <!-- @if($following->profile_image == null)
                                        <img src="{{ $default_image }}" class="rounded-circle" width=50 height="50">
                                    @else
                                        <img src="{{ asset('storage/profile_image/'.$following->profile_image) }}" class="rounded-circle" width="50" height="50">
                                    @endif -->
                                    <div class="ml-2 d-flex flex-column">
                                        <p class="mb-0">{{ $following->name }}</p>
                                        <span class="text-secondary">{{ $following->screen_name }}</span>
                                    </div>
                                    @if ($following->isFollowed($user->id))
                                        <div class="px-2">
                                            <span class="px-1 bg-secondary text-light">フォローされています</span>
                                        </div>
                                    @endif
                                    <div class="d-flex">
                                        <p>{{ $following->description }}</p>
                                    </div>
                                    <div class="d-flex justify-content-end flex-grow-1">
                                        @if ($user->isFollowing($following->id))
                                            <form action="{{ route('unfollow', $following->id) }}" method="POST">
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
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
    <div class="my-4 d-flex justify-content-center">
        {{ $following_users->links() }}
    </div>
@endsection
