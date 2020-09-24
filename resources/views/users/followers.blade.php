@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @if($user == $login_user)
                @include('components.login_user_profile')
            @else
                @include('components.user_profile')
            @endif

            @if (isset($followers))
                <div class="col-md-8">
                    @foreach ($followers as $follower)
                        @if($follower->id != $login_user->id && $follower->id != $user->id)
                            <div class="card mb-3 shadow-sm">
                                <div class="card-haeder p-3 w-100 d-flex">
                                    @include('components.user_image', ['user' => $follower])
                                    <div class="ml-2 d-flex flex-column">
                                        <p class="mb-0">{{ $follower->name }}</p>
                                        <span class="text-secondary">{{ $follower->screen_name }}</span>
                                    </div>
                                    <div class="d-flex justify-content-end ml-auto">
                                        @if ($user->id == $login_user->id)
                                            @if ($login_user->isFollowing($follower->id))
                                                <form action="{{ route('unfollow', $follower->id) }}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn-sm btn-primary rounded-pill shadow-sm">フォロー中</button>
                                                </form>
                                            @else
                                                <form action="{{ route('follow', $follower->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn-sm btn-outline-primary rounded-pill shadow-sm">フォローする</button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex ml-2">
                                        <p>{{ $follower->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @if($follower_count == 0)
    <div class="text-center">フォロワーはまだいません</div>
    @endif
@endsection
