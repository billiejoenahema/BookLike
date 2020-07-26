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
                @foreach ($followers as $follower)
                    @if($follower->id != $login_user->id && $follower->id != $user->id)
                        <div class="col-md-8">
                            <div class="card mb-1">
                                <div class="card-haeder p-3 w-100 d-flex">
                                    @include('components.user_image', ['user' => $follower])
                                    <div class="ml-2 d-flex flex-column">
                                        <p class="mb-0">{{ $follower->name }}</p>
                                        <span class="text-secondary">{{ $follower->screen_name }}</span>
                                    </div>
                                    <div class="d-flex">
                                        <p>{{ $follower->description }}</p>
                                    </div>
                                    <div class="d-flex justify-content-end ml-auto">
                                        @if ($login_user->isFollowing($follower->id))
                                            <form action="{{ route('unfollow', $follower->id) }}" method="POST">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger shadow-sm">フォロー中</button>
                                            </form>
                                        @else
                                            <form action="{{ route('follow', $follower->id) }}" method="POST">
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
        {{ $followers->links() }}
    </div>
@endsection
