@extends('layouts.app')

@section('content')
<div class="d-flex flex-row align-items-center mb-1" id="index-toggle">
    <a href="{{ url('reviews') }} " class="text-reset">
        <div class="switch-index bg-blog text-white text-center">投稿一覧</div>
    </a>
    <div class="switch-index bg-blogLight text-wisper text-center align-items-center">ユーザー一覧</div>
</div>
<div id="userIndex"></div>
@include('components.scroll_to_top_button')
@endsection
