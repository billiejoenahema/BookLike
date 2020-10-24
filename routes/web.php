<?php

use App\Models\User;

Route::get('/', function () {
    if (Auth::check()) {
        return Redirect::to('/reviews');
    }
    return view('welcome');
});

Auth::routes();

// ログイン状態
Route::group(['middleware' => 'auth'], function() {

    // ユーザ関連
    Route::resource('users', 'UsersController', ['only'
    => ['index', 'show', 'edit', 'update', 'destroy']]);

    // 書籍検索（resourceよりも上に書かないと'404 Not found'になってしまう）
    Route::get('reviews/search_items', 'Api\SearchItemsController')->name('search_items');

    // レビュー入力画面（resourceよりも上に書かないと'404 Not found'になってしまう）
    Route::get('reviews/posts', 'ReviewController@posts')->name('reviews.posts');

    // レビュー関連
    Route::resource('reviews', 'ReviewController');

    // コメント関連
    Route::resource('comments', 'CommentsController', ['only' => ['store', 'destroy']]);

    Route::get('terms', function(User $user) {
        $login_user = auth()->user();
        return view('/terms', compact('login_user'));
    });

    Route::get('privacy', function(User $user) {
        $login_user = auth()->user();
        return view('/privacy', compact('login_user'));
    });
});
