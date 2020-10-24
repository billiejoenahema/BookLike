<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Review;
use App\Models\Follower;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request, User $user, Review $review, Follower $follower)
    {
        $login_user = auth()->user();
        $user_id = $login_user->id;

        return view('users.index', compact(
            'users',
            'login_user'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Review $review, Follower $follower)
    {
        $login_user = auth()->user();

        return view('users.show', compact(
            'user',
            'login_user',
        ));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(User $user)
        {
            $login_user = auth()->user();

        return view('users.edit', compact(
            'login_user',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'screen_name'   => ['required', 'string', 'max:50', Rule::unique('users')->ignore($user->id)],
            'name'          => ['required', 'string', 'max:50'],
            'description'   => ['string', 'max:255'],
            'profile_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
        ]);
        $validator->validate();
        $user->updateProfile($data);

        return redirect('users/'.$user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $login_user = auth()->user();
        $login_user->delete();

        return redirect('/');
    }

    // フォローする
    public function follow(User $user)
    {
        $login_user = auth()->user();
        // フォローしているか
        $is_following = $login_user->isFollowing($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $login_user->follow($user->id);
            return back();
        }
        return;
    }

    // フォロー解除
    public function unfollow(Int $id, User $user)
    {
        $login_user = auth()->user();
        // フォローしているか
        $is_following = $login_user->isFollowing($id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $login_user->unfollow($id);
            return back();
        }
        return;
    }

    // フォローしている全ユーザー
    public function following(User $user, Review $review, Follower $follower, $id)
    {
        $followingUsers = $user->getFollowingUsers($id);
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($id);
        $is_followed = $login_user->isFollowed($id);
        $review_count = $review->getReviewCount($id);
        $follow_count = $follower->getFollowCount($id);
        $follower_count = $follower->getFollowerCount($id);
        $favorite_reviews_count = $review->getFavoriteReviews($id)->count();

        return response()->json(
            [
                'followingUsers' => $followingUsers
            ]);
    }

    // 全フォロワー
    public function followers(User $user, Review $review, Follower $follower)
    {
        $followers = $user->getFollowers($user->id);
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $review_count = $review->getReviewCount($user->id);
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);
        $favorite_reviews_count = $review->getFavoriteReviews($user->id)->count();

        return view('users.followers', compact(
            'followers',
            'user',
            'login_user',
            'is_following',
            'is_followed',
            'review_count',
            'follow_count',
            'follower_count',
            'favorite_reviews_count',
        ));
    }

}
