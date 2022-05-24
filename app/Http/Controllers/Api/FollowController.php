<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class FollowController extends Controller
{
    /**
     * フォローする。
     *
     * @param  int  $review_id
     * @return array<string, string>
     */
    public function attachFollow(Int $id)
    {
        $login_user = Auth::user();
        $is_following = $login_user->isFollowing($id);

        // フォローしていなければフォローする
        if(!$is_following) {
            $login_user->follows()->attach($login_user->id);
            return ['status' => 'success'];
        }
        return ['status' => 'error'];
    }

    /**
     * フォロー解除する。
     *
     * @param  int  $review_id
     * @return array<string, string>
     */
    public function detachFollow(Int $id)
    {
        $login_user = Auth::user();
        $is_following = $login_user->isFollowing($id);

        // フォローしていればフォローを解除する
        if($is_following) {
            $login_user->follows()->detach($login_user->id);
            return ['status' => 'success'];
        }
        return ['status' => 'error'];
    }
}
