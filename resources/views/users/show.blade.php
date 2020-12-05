@extends('layouts.app')

@section('content')
@include('components.index_toggle')
@include('components.back_button')

@if($user == $login_user)
@include('components.login_user_profile')
@else
@include('components.user_profile')
@endif

@include('components.bookshelf')

<!-- React-tabs -->
<div id="userPageTab"></div>
@include('components.scroll_to_top_button')
@endsection
