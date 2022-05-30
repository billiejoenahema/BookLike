<?php

namespace App\Services;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewService
{
    public $timestamps = false;

    /**
     * 投稿済みかどうかを返す。
     *
     * @param  string $asin
     * @return boolean
     */
    public function isPosted(String $asin)
    {
        $user = Auth::user();
        return Review::where('user_id', $user->id)
            ->where('asin', $asin)
            ->exists();
    }


}
