@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 justify-content-center m-auto">
            <div class="mb-3">
                <form method="GET" action="{{ route('users.index') }}" class="form-inline my-2 my-lg-0">
                    @csrf
                    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="ユーザー検索" required autocomplete="on">
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
                            <div class="d-flex flex-row col-11">
                                <div class="ml-2 d-flex flex-column">
                                    <a href="{{ url('users/' .$user->id) }}" class="text-reset">
                                        <p class="mb-0">{{ $user->name }}</p>
                                        <span class="text-secondary">{{ $user->screen_name }}</span>
                                    </a>
                                </div>

                                @if ($login_user->isFollowed($user->id))
                                <div class="px-2">
                                    <span class="px-1 bg-secondary text-light rounded">フォローされています</span>
                                </div>
                                @endif


                                <!-- フォローボタン -->
                                <div class="d-flex justify-content-end ml-auto">
                                    @if ($login_user->isFollowing($user->id))
                                        <form action="{{ route('unfollow', $user->id) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn-sm btn-primary shadow-sm rounded-pill">フォロー中</button>
                                        </form>
                                    @else
                                        <form action="{{ route('follow', $user->id) }}" method="POST">
                                            @csrf

                                            <button type="submit" class="btn-sm btn-outline-primary shadow-sm rounded-pill">フォローする</button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <div class="px-2 col-11">
                                <p>{{ \Illuminate\Support\Str::limit($user->description, 200, '・・・') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div>
            {{ $users->links('vendor.pagination.custom-pagination') }}
        </div>
    </div>
@endsection
