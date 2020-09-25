<?php

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\Follower;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth'], function() {

    Route::get('/reviews',function (Request $request, Review $review, User $user) {

        $timelines = Review::with('user')->with('comments')->with('favorites')->orderBy('created_at', 'DESC')->get();
        $populars = Review::withCount('favorites')->with('comments')->with('favorites')->with('user')->orderBy('favorites_count', 'DESC')->get();
        $loginUser = auth()->user();

        return
            [
            'timelines' => $timelines,
            'populars' => $populars,
            'loginUser' => $loginUser
            ];
    });

    Route::get('/users/{user}',function (Request $request, Review $review, User $user, Follower $follower) {

        $loginUserId = auth()->user()->id;
        $loginUser = $user->with('followers')->find($loginUserId);

        // ユーザーの投稿
        $userReviews = $review->where('user_id', $user->id)
            ->with(['user', 'comments', 'favorites'])
            ->orderBy('created_at', 'DESC')
            ->get();

        // いいねした投稿
        $favoriteReviews = $review->getFavoriteReviews($user->id);

        //フォローしているユーザー
        $followingUsers = $user->getFollowingUsers($user->id);

        // フォロワー
        $followedUsers = $user->getFollowers($user->id);

        return
            [
                'loginUser' => $loginUser,
                'userReviews' => $userReviews,
                'favoriteReviews' => $favoriteReviews,
                'followingUsers' => $followingUsers,
                'followedUsers' => $followedUsers
            ];
    });

    Route::get('/users', function (Request $request, User $user, Follower $follower) {

        $loginUserId = auth()->user()->id;
        $loginUser = $user->with('followers')->find($loginUserId);

        // ログインユーザー以外のすべてのユーザー
        $allUsers = $user->getAllUsers($loginUserId)->with('followers')->orderBy('created_at', 'DESC')->get();

        return
            [
                'loginUser' => $loginUser,
                'allUsers' => $allUsers
            ];
    });

    Route::post('favorites', 'Api\FavoriteController@store');
    Route::delete('favorites/{id}', 'Api\FavoriteController@destroy');

    // フォロー/フォロー解除
    Route::post('users/{id}/follow', 'Api\UsersController@follow');
    Route::delete('users/{id}/unfollow', 'Api\UsersController@unfollow');

});
