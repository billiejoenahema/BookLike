@extends('layouts.app')

@section('content')
<div class="d-flex flex-row align-items-center" id="index-toggle">
    <a href="{{ url('reviews') }} " class="text-reset">
        <div class="switch-index bg-blog text-light text-center">投稿一覧</div>
    </a>
    <div class="switch-index bg-blogLight text-white text-center align-items-center">ユーザー一覧</div>
</div>
<div id="userIndex"></div>
@include('components.new_post_button')
@endsection
