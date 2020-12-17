<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;

class ReviewController extends Controller
{
    public function show(Review $review, User $user)
    {
        $loginUser = auth()->user();
        $review = $review->with('favorites')
                    ->where('id', $review->id)
                    ->first();

        return
            [
                'loginUser' => $loginUser,
                'review' => $review
            ];
    }

    public function index(Request $request, Review $review, User $user)
    {
        $sort = $request['sort'];
        $loginUser = auth()->user();
        $pagination = 5;

        // 並び替えられた投稿一覧
        $timelines = $review->sortTimeline($sort, $pagination);

        return
            [
            'timelines' => $timelines,
            'loginUser' => $loginUser,
            ];
    }
}
