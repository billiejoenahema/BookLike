@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 justify-content-center m-auto">
            <!-- ユーザー検索フォーム -->
            <div class="mb-3">
                <form method="GET" action="{{ route('users.index') }}" class="form-inline my-2 my-lg-0">
                    @csrf
                    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="ユーザー検索" required autocomplete="on">
                    <button class="btn my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            @if(isset($search))
            <div class="mb-3">
                <h3 class="text-center">検索結果 "{{ $search }}"</h3>
                @if (count($users) == 0)
                <div class="text-center">キーワードにマッチするユーザーは見つかりませんでした</div>
                @endif
            </div>
            <div class="mb-3 text-right">
                <a href="{{ url('users') }}">ユーザ一覧</a>
            </div>
            @endif
        </div>

        <div class="row justify-content-center m-auto">
            <div class="col-md-8">
                <div id="userIndex"></div>
            </div>
        </div>
    </div>
@endsection
