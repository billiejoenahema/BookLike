@extends('layouts.app')

@section('content')
    <div class="container px-0">
        <div class="col-md-8 justify-content-center m-auto">
            <div class="mb-3 text-right">
                <a href="{{ url('users') }}">ユーザ一覧</a>
            </div>
        </div>

        <div class="row justify-content-center m-auto">
            <div id="userIndex" class="col-md-8"></div>
        </div>
    </div>
@endsection
