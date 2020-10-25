@extends('layouts.app')
@section('content')
<div class="d-flex flex-row align-items-center" id="index-toggle">
    <div class="switch-index bg-blogLight text-light text-center">投稿一覧
    </div>
    <a href="{{ url('users') }} " class="text-reset">
        <div class="switch-index bg-blog text-white text-center align-items-center">ユーザー一覧</div>
    </a>
</div>
<div id="reviewIndex"></div>
@include('components.new_post_button')
@endsection
