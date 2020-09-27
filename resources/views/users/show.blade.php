@extends('layouts.app')

@section('content')
<div class="container justify-content-center px-0">
    <div class="col-md-8 m-auto">
        <div class="mb-3 text-right">
            <a href="{{ url('users') }}">ユーザ一覧</a>
        </div>
    <!-- <div class="row justify-content-center"> -->
        @if($user == $login_user)
            @include('components.login_user_profile')
        @else
            @include('components.user_profile')
        @endif
        <!-- React-tabs -->
        <div id="userPageTab"></div>
    <!-- </div> -->
    </div>
</div>
@endsection
