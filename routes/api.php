<?php

Route::group(['middleware' => 'auth'], function () {

    // 書籍検索（resourceよりも上に書かないと'404 Not found'になってしまう）
    Route::get('/reviews/search_items', 'Api\SearchItemsController')->name('search_items');

    // 投稿関連
    Route::resource('/reviews', 'Api\ReviewController', ['only' => ['index', 'show']]);

    // ユーザー関連
    Route::resource('/users', 'Api\UserController', ['only' => ['index', 'show']]);

    // いいね機能
    Route::post('/add_favorite/{id}', 'Api\FavoriteController@addFavorite')->where('id', '[0-9]+');
    Route::post('/remove_favorite/{id}', 'Api\FavoriteController@removeFavorite')->where('id', '[0-9]+');

    // フォロー/フォロー解除
    Route::post('/follow/{id}', 'Api\FollowController@follow')->where('id', '[0-9]+');
    Route::post('/unfollow/{id}', 'Api\FollowController@unfollow')->where('id', '[0-9]+');
});
