<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;

class FollowService
{
    public $timestamps = false;

    /**
     * フォローしているかどうかを返す。
     *
     * @param  Int  $id
     * @return Bool
     */
    public function isFollowing(Int $id)
    {
        $loginUser = Auth::user();
        return $loginUser->follows()
            ->where('followed_id', $id)
            ->exists();
    }

    /**
     * フォローされているかどうかを返す。
     *
     * @param  Int  $id
     * @return Bool
     */
    public function isFollowed(Int $id)
    {
        $loginUser = Auth::user();
        return $loginUser->followers()
            ->where('following_id', $id)
            ->exists();
    }
}
