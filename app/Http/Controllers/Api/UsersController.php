<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(User $user, Review $review)
    {
        $loginUserId = auth()->user()->id;
        $loginUser = $user->with('followers')->find($loginUserId);
        $users = $user->getAllUsers($loginUserId)
            ->with('followers')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        $populars = $user->getAllUsers($loginUserId)
            ->with('followers')
            ->withCount('followers')
            ->orderBy('followers_count', 'DESC')
            ->paginate(10);

        return
            [
                'loginUser' => $loginUser,
                'users' => $users,
                'populars' => $populars
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
        $userReviews = $review->where('user_id', $user->id)
            ->with(['user', 'comments', 'favorites'])
            ->orderBy('created_at', 'DESC')
            ->get();
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
