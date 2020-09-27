@extends('layouts.app')

@section('content')
    <div class="container px-0">
        <div class="col-md-8 justify-content-center m-auto">
            <!-- ユーザー検索フォーム -->
            <div class="mb-3">
                <form method="GET" action="{{ route('users.index') }}" class="form-inline">
                    @csrf
                    <input class="form-control col-10 col-md-6" name="search" type="search" placeholder="Search" aria-label="ユーザー検索" required autocomplete="on">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
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
            <div id="userIndex" class="col-md-8"></div>
        </div>
    </div>
@endsection
