<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Comment;
use App\Models\GetItem;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('reviews.index');
    }

    /**
     * Post review text form.
     *
     * @param Request $request
     */
    public function post(Request $request)
    {
        $get_item = new GetItem;
        $review = new Review;
        $asin = $request->asin;
        $item = $get_item->getItem($asin);
        $page_url = $item->DetailPageURL ?? NULL;
        $title = $item->ItemInfo->Title->DisplayValue ?? NULL;
        $author = $item->ItemInfo->ByLineInfo->Contributors[0]->Name ?? NULL;
        $manufacturer = $item->ItemInfo->ByLineInfo->Manufacturer->DisplayValue ?? NULL;
        $image_url = $item->Images->Primary->Large->URL ?? NULL;

        // 選択した書籍と同じ書籍が投稿済みかどうかをチェック
        $isPosted = $review->isPosted($asin, auth()->user()->id);
        // 投稿済みならエラーメッセージを表示
        if ($isPosted) {
            return back()->with('error', 'この本はすでに投稿済みです');
        }

        return view('reviews.post', compact(
            'asin',
            'page_url',
            'title',
            'author',
            'manufacturer',
            'image_url',
        ));
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

    /**
     * Display the specified resource.
     *
     * @param  Review $review
     * @param  Comment $comment
     * @return \Illuminate\View\View
     */
    public function show(Review $review, Comment $comment)
    {
        $review = $review->getReview($review->id);
        $comments = $comment->getComments($review->id);

        return view('reviews.show', compact(
            'review',
            'comments',
        ));
    }

    /**
     * Show the form for editing the review.
     *
     * @param  Review $review
     * @return \Illuminate\View\View
     */
    public function edit(Review $review)
    {
        return view('reviews.edit', compact(
            'review'
        ));
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