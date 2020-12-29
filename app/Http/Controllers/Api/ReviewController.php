<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use DateTime;

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
        $category = $request['category'];
        $criteria = $request['criteria'];
        $search = $request['search'];
        $pagination = 6;
        $loginUser = auth()->user();

        // 並び替えられた投稿一覧
        $timelines = $review->getTimeline($sort, $category, $criteria, $search, $pagination);

        return
            [
            'timelines' => $timelines,
            'loginUser' => $loginUser,
            ];
    }
}
