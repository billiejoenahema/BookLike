@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('components.cross_button')
            <div class="card shadow-sm">
                <div class="card-header">編集</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('reviews.update', $reviews) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row mb-0">
                            <div class="col-md-12 p-3 w-100 d-flex">
                                @include('components.user_image', ['user' => $login_user])

                                <div class="ml-2 d-flex flex-column">
                                    <p class="mb-0">{{ $login_user->name }}</p>
                                    <span class="text-secondary">{{ $login_user->screen_name }}</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control
                                @error('text') is-invalid @enderror"
                                name="text"
                                required
                                autocomplete="text"
                                rows="4"
                                >{{ old('text') ? : $reviews->text }}</textarea>

                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <p class="mb-4 text-danger">200文字以内</p>
                                <button type="submit" class="btn btn-primary shadow-sm">
                                    投稿する
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
