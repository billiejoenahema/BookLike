@extends('layouts.app')

@section('content')
@include('components.index_toggle')
@include('components.back_button')
<h6 class="mt-4">レビュー詳細</h6>
<div id="showReview"></div>

<!-- コメント -->
@include('components.comment')
@include('components.delete_review_confirm')
@endsection
