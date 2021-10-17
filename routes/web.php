<?php

// 認証機能
// Auth::routes();
Auth::routes(['verify' => true]);

// ログイン＆ログアウト時のリダイレクト
Route::get('/', 'RootController');

// ゲストログイン用ルート
Route::get('guest', 'Auth\LoginController@guestUserLogin')->name('login.guest');

// ログイン中のルーティング
Route::group(['middleware' => ['auth', 'verified']], function () {

    // ユーザ関連
    Route::resource('users', 'UserController', ['only'
    => ['index', 'show', 'edit', 'update', 'destroy']]);

    // レビュー入力画面（resourceよりも上に書かないと'404 Not found'になってしまう）
    Route::get('reviews/post', 'ReviewController@post')->name('reviews.post');

    // レビュー関連
    Route::resource('reviews', 'ReviewController');

    // コメント関連
    Route::resource('comments', 'CommentController', ['only' => ['store', 'destroy']]);

    // 利用規約
    Route::view('/terms', 'terms');

    // プライバシーポリシー
    Route::view('/privacy', 'privacy');
});