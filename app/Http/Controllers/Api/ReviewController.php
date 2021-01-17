<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;

class ReviewController extends Controller
{

    public function index(Request $request, Review $review, User $user)
    {
        $pagination = 6;
        $loginUser = auth()->user();

        // 並び替えられた投稿一覧
        $reviews = $review->getReviews($request, $pagination);

        return
            [
                'reviews' => $reviews,
                'loginUser' => $loginUser,
            ];
    }

    public function show(Request $request, Review $review)
    {
        $loginUser = auth()->user();
        $reviewId = $request->review->id;
        $review = $review->getReview($reviewId);

        return
            [
                'review' => $review,
                'loginUser' => $loginUser,
            ];
    }

    public function edit(Review $review)
    {
        $review = $review->with('favorites')
                        ->where('id', $review->id)
                        ->first();
        $ratings = $review->ratings;
        return
            [
                'ratings' => $ratings
            ];
    }
}
