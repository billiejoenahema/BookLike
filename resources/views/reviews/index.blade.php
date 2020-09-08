@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3 text-right">
            <a href="{{ url('users') }}">ユーザ一覧</a>
        </div>
        <div class="col-md-8">
            <!-- React-tabs -->
            <div id="reviewsTab"></div>
        </div>
    </div>
</div>
@endsection
