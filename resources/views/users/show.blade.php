@extends('layouts.app')

@section('content')
@include('components.back_button')
@if($user == $login_user)
@include('components.login_user_profile')
@else
@include('components.user_profile')
@endif
<!-- React-tabs -->
<div id="userPageTab"></div>
@endsection
