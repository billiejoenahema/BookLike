@extends('layouts.app') @section('content') @include('components.back_button')
<div class="card shadow-sm">
    <form
        method="POST"
        action="{{ route('reviews.destroy', $review->id) }}"
        id="delete_{{ $review->id }}"
    >
        @csrf @method('DELETE')
        <div
            class="
                card-header
                d-flex
                align-items-center
                justify-content-between
            "
        >
            <div class="h5 mb-0">編集</div>
            {{-- 投稿削除ボタン --}}
            <a
                href="#"
                role="button"
                data-toggle="modal"
                data-target="#deleteReview"
                title="投稿を削除"
                class="text-secondary mb-0 d-block h5"
            >
                <i class="fas fa-trash"></i>
            </a>
        </div>
    </form>
    <div class="card-body">
        <div class="pr-3 pb-3 w-100 d-flex">
            @include('components.user_image', ['user' => $login_user])
            <div class="ml-2 d-flex flex-column">
                <p class="mb-0">
                    {{ $login_user->name ?? $login_user->screen_name }}
                </p>
                <span
                    class="text-secondary"
                    >{{ $login_user->screen_name }}</span
                >
            </div>
        </div>
        <form
            method="POST"
            action="{{ route('reviews.update', $review) }}"
            id="reviewEdit"
        >
            @csrf @method('PUT')
            <div class="d-flex pt-2 border-top form-group mb-0">
                {{-- 書籍イメージ --}}
                <div class="py-2 pr-4">
                    <img
                        src="{{ $review->image_url }}"
                        width="128"
                        class="shadow-sm"
                    />
                </div>
                <div class="col-md-8 d-flex flex-column text-left py-2 px-0">
                    <h5>{{ $review->title }}</h5>
                    <ul class="list-unstyled mb-2">
                        <li class="list-item">著者：{{ $review->author }}</li>
                        <li class="list-item">
                            出版社：{{ $review->manufacturer }}
                        </li>
                        <li class="list-item">
                            カテゴリー：{{ $review->category }}
                        </li>
                        <li class="list-item mt-2">
                            評価：<label
                                for="ratings"
                                class="ratings-value mb-0"
                                >{{ $review->ratings}}</label
                            >
                            <div class="d-flex">
                                {{-- 評価 --}}
                                <div
                                    class="
                                        flex-row
                                        text-mango
                                        lead
                                        border
                                        py-1
                                        px-3
                                    "
                                    id="ratings"
                                    data-ratings="{{ $review->ratings }}"
                                    title="クリックして選択"
                                >
                                    <span
                                        ><i
                                            id="1"
                                            onclick="changeStars(this)"
                                            class="edit-star far fa-star"
                                        ></i
                                    ></span>
                                    <span
                                        ><i
                                            id="2"
                                            onclick="changeStars(this)"
                                            class="edit-star far fa-star"
                                        ></i
                                    ></span>
                                    <span
                                        ><i
                                            id="3"
                                            onclick="changeStars(this)"
                                            class="edit-star far fa-star"
                                        ></i
                                    ></span>
                                    <span
                                        ><i
                                            id="4"
                                            onclick="changeStars(this)"
                                            class="edit-star far fa-star"
                                        ></i
                                    ></span>
                                    <span
                                        ><i
                                            id="5"
                                            onclick="changeStars(this)"
                                            class="edit-star far fa-star"
                                        ></i
                                    ></span>
                                </div>
                                <input
                                    type="hidden"
                                    name="ratings"
                                    id="inputRatings"
                                    value="{{ $review->ratings }}"
                                />
                            </div>
                        </li>
                    </ul>
                    {{-- ネタバレありなし選択 --}}
                    <div class="d-flex-column">
                        <label for="spoiler" class="d-flex mb-0"
                            >ネタバレ：</label
                        >
                        <select name="spoiler" class="form-controll p-1">
                            @if($review->spoiler === 0)
                            <option value="0" selected>ネタバレなし</option>
                            <option value="1">ネタバレあり</option>
                            @else
                            <option value="0">ネタバレなし</option>
                            <option value="1" selected>ネタバレあり</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-12">
                    <label class="d-inline text-blog font-weight-bold"
                        >レビュー</label
                    >
                    <textarea
                        class="form-control @error('text') is-invalid @enderror"
                        name="text"
                        id="textarea"
                        autocomplete="text"
                        rows="6"
                        onkeyup="checkTextLength()"
                        >{{ old('text') ? : $review->text }}</textarea
                    >
                    @error('text')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ "800文字まで投稿可能です" }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-12 text-right">
                    <p id="currentLength">
                        {{ mb_strlen($review->text) ?? '0'}} / 800文字
                    </p>
                    <div class="w-100 m-0 row justify-content-end">
                        <button
                            type="button"
                            onclick="history.back()"
                            class="btn btn-secondary rounded-pill"
                        >
                            キャンセル
                        </button>
                        <button
                            id="postButton"
                            type="submit"
                            class="btn btn-primary rounded-pill shadow-sm ml-4"
                        >
                            投稿を編集する
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@include('components.delete_review_confirm') @endsection
