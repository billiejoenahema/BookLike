@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($all_users as $user)
                    <div class="card mb-1">
                        <div class="card-haeder p-3 w-100 d-flex">
                            @include('components.user_image')
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $user->name }}</p>
                                <span class="text-secondary">{{ $user->screen_name }}</span>
                            </div>
                            @if (auth()->user()->isFollowed($user->id))
                                <div class="px-2">
                                    <span class="px-1 bg-secondary text-light">フォローされています</span>
                                </div>
                            @endif
                            <div class="d-flex justify-content-end flex-grow-1">
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
            {{ $all_users->links() }}
        </div>
    </div>
@endsection
