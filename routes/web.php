<?php

// 認証機能
Auth::routes();

// ログイン＆ログアウト時のリダイレクト
Route::get('/', 'RootController');

// ゲストログイン用ルート
Route::get('guest', 'Auth\LoginController@guestUserLogin')->name('login.guest');

// ログイン中のルーティング
Route::group(['middleware' => 'auth'], function() {

    // ユーザ関連
    Route::resource('users', 'UsersController', ['only'
    => ['index', 'show', 'edit', 'update', 'destroy']]);

    // レビュー入力画面（resourceよりも上に書かないと'404 Not found'になってしまう）
    Route::get('reviews/post', 'ReviewController@post')->name('reviews.post');

    // レビュー関連
    Route::resource('reviews', 'ReviewController');

    // コメント関連
    Route::resource('comments', 'CommentsController', ['only' => ['store', 'destroy']]);

    // 利用規約
    Route::get('terms', 'TermsController');

    // プライバシーポリシー
    Route::get('privacy', 'PrivacyController');
});
