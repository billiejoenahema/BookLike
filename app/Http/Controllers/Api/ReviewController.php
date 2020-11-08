<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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
        $storage = Storage::disk('s3');

        return
            [
                'loginUser' => $loginUser,
                'review' => $review,
                'storage' => $storage
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
        $storage = Storage::disk('s3');

        return
            [
            'timelines' => $timelines,
            'loginUser' => $loginUser,
            'favoritest' => $favoritest,
            'storage' => $storage
            ];
    }
}
