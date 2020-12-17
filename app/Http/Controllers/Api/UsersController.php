<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\Favorite;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(User $user, Review $review, Favorite $favorite)
    {
        $loginUserId = auth()->user()->id;
        $loginUser = $user->with('followers')->find($loginUserId);

        // updated_at順にユーザーを取得
        $users = $user->getAllUsers($loginUserId)
            ->with(['followers', 'reviews' => function($query) {
                $query->with('favorites');
                }])
            ->orderBy('updated_at', 'DESC')
            ->paginate(10);

        // フォロワーが多い順にユーザーを取得
        $populars = $user->getAllUsers($loginUserId)
            ->with(['followers', 'reviews' => function($query) {
                $query->with('favorites');
                }])
            ->withCount('followers')
            ->orderBy('followers_count', 'DESC')
            ->paginate(10);

        // いいね獲得数をカウントして追加
        $ratings = $users->map(function($user, $key) {
            $favorites_count = $user->reviews->count('favorites');
            $user['favorites_count'] = $favorites_count;
            return $user;
        });


        // いいね獲得数が多い順に並び替え
        $sorted_ratings = $ratings->sortByDesc('favorites_count');

        return
            [
                'loginUser' => $loginUser,
                'users' => $users,
                'populars' => $populars,
                'sorted_ratings' => $sorted_ratings,
            ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Review $review, User $user)
    {
        $profileUserId = $request->user->id;
        $profileUser = $user->with('followers')->find($profileUserId);
        $loginUserId = auth()->user()->id;
        $loginUser = $user->with('followers')->find($loginUserId);
        // 投稿
        $userReviews = $review->getUserReviews($user->id);
        // いいねした投稿
        $favoriteReviews = $review->getFavoriteReviews($user->id);
        // フォローしているユーザー
        $followingUsers = $user->getFollowingUsers($user->id);
        // フォロワー
        $followedUsers = $user->getFollowers($user->id);

        return
            [
                'profileUser' => $profileUser,
                'loginUser' => $loginUser,
                'userReviews' => $userReviews,
                'favoriteReviews' => $favoriteReviews,
                'followingUsers' => $followingUsers,
                'followedUsers' => $followedUsers
            ];
    }

    // フォローする
    public function follow(User $user)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($user->id);

        // フォローしていなければフォローする
        if(!$is_following) {
            $login_user->follow($user->id);
            return back();
        }
        return;
    }

    // フォロー解除
    public function unfollow(Int $id, User $user)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($id);

        // フォローしていればフォローを解除する
        if($is_following) {
            $login_user->unfollow($id);
            return back();
        }
        return;
    }

}
