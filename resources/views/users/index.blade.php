@extends('layouts.app')

@section('content')
    <div class="container px-0">
        <div class="col-md-8 m-auto">
            <div class="mb-3 text-right">
                <a href="{{ url('users') }}">ユーザ一覧</a>
            </div>
            <div id="userIndex"></div>
        </div>
    </div>
@endsection
