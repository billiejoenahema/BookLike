@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @if($user == $login_user)
                @include('components.login_user_profile')
            @else
                @include('components.user_profile')
            @endif

            @if (isset($following_users))
                @foreach ($following_users as $following)
                    @if($following->id != $login_user->id && $following->id != $user->id)
                        <div class="col-md-8">
                            <div class="card mb-1 shadow-sm">
                                <div class="card-haeder p-3 w-100 d-flex">
                                    @include('components.user_image', ['user' => $following])
                                    <div class="ml-2 d-flex flex-column">
                                        <p class="mb-0">{{ $following->name }}</p>
                                        <span class="text-secondary">{{ $following->screen_name }}</span>
                                    </div>

                                    <div class="d-flex flex-column">
                                        @if ($following->isFollowed($user->id))
                                            <div class="px-2 mb-3">
                                                <span class="px-1 bg-secondary text-light rounded">フォローされています</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="d-flex justify-content-end ml-auto">
                                        <form action="{{ route('unfollow', $following->id) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn-sm btn-primary shadow-sm rounded-pill">フォロー中</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="px-2">
                                        <p>{{ $following->description }}</p>
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
