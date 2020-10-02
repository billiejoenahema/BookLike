@extends('layouts.app')

@section('content')
    <div class="container px-0">
        <div class="col-md-10 col-lg-8 m-auto">
            <div class="mb-3 text-right">
                <a href="{{ url('users') }}">ユーザ一検索</a>
            </div>
            <div id="userIndex"></div>
        </div>
    </div>
@endsection
