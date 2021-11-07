<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $pagination = config('PAGINATION.USERS');
        $review = new Review;

        // 並び替えられた投稿一覧
        $reviews = $review->getReviews($request, $pagination);
        return ReviewResource::collection($reviews);
    }

    /**
     * Store new review.
     *
     * @param  StoreReviewRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreReviewRequest $request)
    {
        $review = new Review;
        $review->reviewStore(auth()->user()->id, $request);
        session()->flash('flash_message', 'レビューを投稿しました');
        return redirect('reviews');
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

    /**
     * Show the form for editing the review.
     *
     * @param  Review $review
     * @return \Illuminate\View\View
     */
    public function edit(Review $review)
    {
        dd($review);
        $review = $review->with('favorites')
            ->where('id', $review->id)
            ->first();
        return new ReviewResource($review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateReviewRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateReviewRequest $request)
    {
        $review = new Review;
        $review->reviewUpdate($request);
        session()->flash('flash_message', '投稿を編集しました');

        return redirect('reviews');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int $review_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($review_id)
    {
        Review::where('id', $review_id)
            ->delete();
        session()->flash('flash_message', '投稿を削除しました');

        return redirect('reviews');
    }
}