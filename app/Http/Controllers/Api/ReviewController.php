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
     * レビュー一覧を取得する。
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $query = Review::withCount(['favorites', 'comments'])
            ->with(['user', 'favorites']);

        // カテゴリーで絞り込み
        $query->when($request['category'], function ($query) use ($request) {
            return $query->where('category', $request['category']);
        });

        // 検索
        $query->when($request['search'], function ($query) use ($request) {
            $search = $request['search'];
            return $query->where($request['criteria'], 'LIKE', "%$search%");
        });

        $reviews = $query->sortedReviews($request['sort']);
        return ReviewResource::collection($reviews);
    }

    /**
     * レビューを新規登録する。
     *
     * @param  StoreReviewRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreReviewRequest $request)
    {
        DB::transaction(function () use ($request) {
            $loginUser = Auth::user();
            Review::create([
                'user_id' => $loginUser->id,
                'category' => $request['category'],
                'asin' => $request['asin'],
                'page_url' => $request['page_url'],
                'title' => $request['title'],
                'author' => $request['author'],
                'manufacturer' => $request['manufacturer'],
                'image_url' => $request['image_url'],
                'ratings' => $request['ratings'],
                'spoiler' => $request['spoiler'],
                'text' => $request['text'],
            ]);
        });
        session()->flash('flash_message', 'レビューを投稿しました');
        return redirect('reviews');
    }

    /**
     * レビュー詳細を取得する。
     *
     * @param  Int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(Int $id)
    {
        $query = Review::withCount(['favorites', 'comments'])
            ->with(['user', 'favorites', 'comments' => function ($query) {
                return $query->with('user');
            }]);
        $review = $query->findOrFail($id);

        return new ReviewResource($review);
    }

    /**
     * レビューを更新する。
     *
     * @param  UpdateReviewRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateReviewRequest $request)
    {
        $review = DB::transaction(function () use ($request) {
            $review = Review::findOrFail($request['id']);
            $review->ratings = $request['ratings'];
            $review->spoiler = $request['spoiler'];
            $review->text = $request['text'];
            $review->save();

            return $review;
        });
        session()->flash('flash_message', '投稿を編集しました');

        return new ReviewResource($review);
    }

    /**
     * レビューを削除する。
     *
     * @param  Int $review_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($review_id)
    {
        $review = Review::findOrFail($review_id);
        $review->delete();
        session()->flash('flash_message', '投稿を削除しました');

        return redirect('reviews');
    }
}
