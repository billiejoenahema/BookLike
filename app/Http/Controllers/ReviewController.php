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
    public function index(Review $review, Follower $follower)
    {
        $login_user = auth()->user();
        $follow_ids = $follower->followingIds($login_user->id);
        // followed_idだけ抜き出す
        $following_ids = $follow_ids->pluck('followed_id')->toArray();

        $timelines = $review->getTimelines($login_user->id, $following_ids);
        $default_image = asset('storage/profile_image/Default_User_Icon.jpeg');

        return view('reviews.index', compact(
            'login_user',
            'timelines',
            'default_image'
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
    public function posts(Request $request, GetItem $get_item)
    {
        $login_user = auth()->user();
        $default_image = asset('storage/profile_image/Default_User_Icon.jpeg');

        $asin = $request->asin;
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
    public function show(Review $review, Comment $comment)
    {
        $login_user = auth()->user();
        $review = $review->getReview($review->id);
        $comments = $comment->getComments($review->id);
        $default_image = asset('storage/profile_image/Default_User_Icon.jpeg');


        return view('reviews.show', compact(
            'review',
            'comments',
            'login_user',
            'default_image'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        $login_user = auth()->user();
        $reviews = $review->getEditReview($login_user->id, $review->id);

        if (!isset($review)) {
            return redirect('reviews');
        }

        return view('reviews.edit', compact(
            'login_user',
            'reviews'
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
            'text' => ['required', 'string', 'max:200']
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

        return back();
    }
}
