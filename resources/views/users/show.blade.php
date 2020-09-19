@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if($user == $login_user)
            @include('components.login_user_profile')
        @else
            @include('components.user_profile')
        @endif
        <!-- React-tabs -->
        <div class="col-md-8">
            <div id="mypageTab"></div>
        </div>
    </div>
</div>
@endsection
