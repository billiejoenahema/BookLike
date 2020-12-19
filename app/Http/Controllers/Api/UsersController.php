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

    public function index(Request $request, User $user, Review $review, Favorite $favorite)
    {
        $sort = $request['sort'];
        $pagination = 6;
        $loginUserId = auth()->user()->id;
        $loginUser = $user->with('followers')->find($loginUserId);
        // 並び替えられたユーザー一覧を取得
        $users = $user->sortedUsers($sort, $pagination, $loginUserId);

        return
            [
                'loginUser' => $loginUser,
                'users' => $users,
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
        $profileUserId = $user->id;
        $profileUser = $user->with('followers')->find($profileUserId);
        $loginUserId = auth()->user()->id;
        $loginUser = $user->with('followers')->find($loginUserId);

        // 投稿一覧
        $userReviews = $review->getUserReviews($user->id);
        // いいねした投稿一覧
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
                'followedUsers' => $followedUsers,
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
