<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{

    public function index(Request $request)
    {
        $pagination = config('PAGINATION.USERS');
        $review = new Review;

        // 並び替えられた投稿一覧
        $reviews = $review->getReviews($request, $pagination);
        return ReviewResource::collection($reviews);
    }

    public function show(Request $request)
    {
        $query = Review::withCount(['favorites', 'comments'])
            ->with(['user', 'favorites', 'comments' => function ($query) {
                return $query->with('user');
            }]);
        $id = (int) $request->review;
        $review = $query->findOrFail($id);

        return new ReviewResource($review);
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