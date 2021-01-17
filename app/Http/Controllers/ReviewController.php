<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReview;
use App\Http\Requests\UpdateReview;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\GetItem;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Review $reviews, Follower $follower)
    {
        $login_user = auth()->user();
        $storage = Storage::disk('s3');

        return view('reviews.index', compact(
            'login_user',
            'storage'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 書籍検索フォームをモーダル化したためこのページは不要に
    }

    // Post review text form
    public function post(Request $request, GetItem $get_item, Review $review)
    {
        $login_user = auth()->user();
        $user_id = $login_user->id;
        $storage = Storage::disk('s3');

        $asin = $request->asin;
        $item = $get_item->getItem($asin);
        $page_url = $item->DetailPageURL ?? NULL;
        $title = $item->ItemInfo->Title->DisplayValue ?? NULL;
        $author = $item->ItemInfo->ByLineInfo->Contributors[0]->Name ?? NULL;
        $manufacturer = $item->ItemInfo->ByLineInfo->Manufacturer->DisplayValue ?? NULL;
        $image_url = $item->Images->Primary->Large->URL ?? NULL;

        // 選択した書籍と同じ書籍が投稿済みかどうかをチェック
        $isPosted = $review->isPosted($asin, $user_id);
        // 投稿済みならエラーメッセージを表示
        if($isPosted) {
            return back()->with('error', 'この本はすでに投稿済みです');
        }

        return view('reviews.post', compact(
            'login_user',
            'storage',
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
     * @param  App\Http\Requests\StoreReview  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReview $request, Review $review)
    {
        $login_user = auth()->user();
        $review->reviewStore($login_user->id, $request);
        session()->flash('flash_message', '投稿しました');
        return redirect('reviews');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review, Comment $comment)
    {
        $login_user = auth()->user();
        $review = $review->getReview($review->id);
        $comments = $comment->getComments($review->id);
        $storage = Storage::disk('s3');

        return view('reviews.show', compact(
            'review',
            'comments',
            'login_user',
            'storage'
        ));
    }

    /**
     * Show the form for editing the review.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        $login_user = auth()->user();
        $storage = Storage::disk('s3');

        return view('reviews.edit', compact(
            'login_user',
            'storage',
            'review'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReview $request, Review $review)
    {
        $review->reviewUpdate($review->id, $request);
        session()->flash('flash_message', '投稿を編集しました');

        return redirect('reviews');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review, Request $request)
    {
        $login_user = auth()->user();
        $review->reviewDestroy($login_user->id, $review->id);
        session()->flash('flash_message', '投稿を削除しました');

        return redirect('reviews');
    }
}
