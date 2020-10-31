<?php

Route::group(['middleware' => 'auth'], function() {

    Route::get('/reviews/{review}', 'Api\ReviewController@show');

    Route::get('/reviews', 'Api\ReviewController@index');

    Route::get('/users/{user}', 'Api\UsersController@show');

    Route::get('/users', 'Api\UsersController@index');

    // いいね機能
    Route::post('favorites', 'Api\FavoriteController@store');
    Route::delete('favorites/{id}', 'Api\FavoriteController@destroy');

    // フォロー/フォロー解除
    Route::post('users/{user}/follow', 'Api\UsersController@follow');
    Route::post('users/{id}/unfollow', 'Api\UsersController@unfollow');

});
