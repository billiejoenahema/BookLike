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
        $review = $review
            ->with('favorites')
            ->where('id', $review->id)
            ->first();

        return
            [
                'loginUser' => $loginUser,
                'review' => $review
            ];
    }

    public function index(Review $review, User $user)
    {
        $loginUser = auth()->user();
        $timelines = $review->with('user')
            ->with(['comments','favorites'])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        $favoritest = $review->with('user')
            ->with(['comments', 'favorites'])
            ->withCount('favorites')
            ->orderBy('favorites_count', 'DESC')
            ->paginate(10);

        return
            [
            'timelines' => $timelines,
            'loginUser' => $loginUser,
            'favoritest' => $favoritest
            ];
    }
}
