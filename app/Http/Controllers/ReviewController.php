<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Follower;
use App\Http\Controllers\Api\GetItem;


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
        $timelines = Review::orderBy('created_at', 'DESC')->get();

        return view('reviews.index', compact(
            'login_user',
            'timelines'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $login_user = auth()->user();
        $default_image = asset('storage/profile_image/Default_User_Icon.jpeg');

        return view('reviews.create', compact(
            'login_user',
            'default_image'
        ));
    }

    // Post review text form
    public function posts(Request $request, GetItem $get_item, Review $review)
    {
        $login_user = auth()->user();
        $default_image = asset('storage/profile_image/Default_User_Icon.jpeg');

        $user_id = $login_user->id;
        $asin = $request->asin;
        $posted_review = $review->postedAsin($asin, $user_id);
        $posted_asin = $posted_review['asin'];
        if(isset($posted_asin)) {
            return back()->with('error', 'この本はすでに投稿済みです');
        }
        $get_item = $get_item->getItem($asin);


        return view('reviews.posts', compact(
            'login_user',
            'default_image',
            'get_item'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Review $review)
    {
        $login_user = auth()->user();
        $data = $request->all();

        $validator = Validator::make($data, [
            'asin' => 'required',
            'title' => 'required',
            'image_url' => 'required',
            'text' => 'required | string | max:400'
        ]);

        $validator->validate();
        $review->reviewStore($login_user->id, $data);

        return redirect('reviews');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review, Comment $comment, GetItem $get_item)
    {
        $login_user = auth()->user();
        $review = $review->getReview($review->id);
        $comments = $comment->getComments($review->id);
        $default_image = asset('storage/profile_image/Default_User_Icon.jpeg');
        $item = $get_item->getItem($review->asin);
        $item_url = $item->DetailPageURL;

        return view('reviews.show', compact(
            'review',
            'comments',
            'login_user',
            'default_image',
            'item_url'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review, GetItem $get_item)
    {
        $login_user = auth()->user();
        $review = $review->getEditReview($login_user->id, $review->id);
        // $default_image = asset('storage/profile_image/Default_User_Icon.jpeg');
        $item = $get_item->getItem($review->asin);
        $item_url = $item->DetailPageURL;

        if (!isset($review)) {
            return redirect('reviews');
        }

        return view('reviews.edit', compact(
            'login_user',
            'review',
            'item_url'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'text' => 'required | string | max:400'
        ]);

        $validator->validate();
        $review->reviewUpdate($review->id, $data);

        return redirect('reviews');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $login_user = auth()->user();
        $review->reviewDestroy($login_user->id, $review->id);
        session()->flash('flash_message', '投稿を削除しました');

        return redirect('reviews');
    }
}
