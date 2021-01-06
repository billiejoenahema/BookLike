<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class FollowController extends Controller
{
    public function follow(Int $id, User $user)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($id);

        // フォローしていなければフォローする
        if(!$is_following) {
            $login_user->follow($id);
            return ['status' => 'success'];
        }
        return ['status' => 'error'];
    }

    public function unfollow(Int $id, User $user)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($id);

        // フォローしていればフォローを解除する
        if($is_following) {
            $login_user->unfollow($id);
            return ['status' => 'success'];
        }
        return ['status' => 'error'];
    }
}
