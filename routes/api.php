<?php

Route::group(['middleware' => 'auth'], function() {

    // 書籍検索（resourceよりも上に書かないと'404 Not found'になってしまう）
    Route::get('/reviews/search_items', 'SearchItemsController')->name('search_items');

    // 投稿関連
    Route::resource('/reviews', 'ReviewController', ['only' => ['index', 'show']]);

    // ユーザー関連
    Route::resource('/users', 'UsersController', ['only' => ['index', 'show']]);

    // いいね機能
    Route::post('/add_favorite/{id}', 'FavoriteController@addFavorite');
    Route::post('/remove_favorite/{id}', 'FavoriteController@removeFavorite');

    // フォロー/フォロー解除
    Route::post('/follow/{id}', 'FollowController@follow');
    Route::post('/unfollow/{id}', 'FollowController@unfollow');

});
