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
        $query = Review::withCount(['favorites', 'comments'])
            ->with(['user', 'favorites']);
        $pagination = config('PAGINATION.USERS');

        // カテゴリーで絞り込み
        $query->when($request['category'], function ($query) use ($request) {
            return $query->where('category', $request['category']);
        });

        // 検索
        $query->when($request['search'], function ($query) use ($request) {
            $search = $request['search'];
            return $query->where($request['criteria'], 'LIKE', "%$search%");
        });

        // ソート
        switch ($request['sort']) {
            case 'favorite':
                // いいねが多い順に投稿を並び替え
                $query->orderBy('favorites_count', 'DESC');
            case 'ratings':
                // 評価が高い順に投稿を並び替え
                $query->orderBy('ratings', 'DESC');
            default:
                // 登録順に投稿を並び替え（デフォルト）
                $query->orderBy('created_at', 'DESC');
        }

        $reviews = $query->paginate($pagination);
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
        $review->user_id = auth()->user()->id;
        $review->category = $request->category;
        $review->asin = $request->asin;
        $review->page_url = $request->page_url;
        $review->title = $request->title;
        $review->author = $request->author;
        $review->manufacturer = $request->manufacturer;
        $review->image_url = $request->image_url;
        $review->ratings = $request->ratings;
        $review->spoiler = $request->spoiler;
        $review->text = $request->text;
        $review->save();
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
        $review->id = $request->review;
        $review->ratings = $request->ratings;
        $review->spoiler = $request->spoiler;
        $review->text = $request->text;
        $review->update();
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