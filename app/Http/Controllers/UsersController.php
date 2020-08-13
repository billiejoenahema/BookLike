<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
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

    public function index(Request $request, User $user)
    {
        $login_user = auth()->user();
        $user_id = $user->id;
        $default_image = asset('storage/profile_image/Default_User_Icon.jpeg');
        $search = $request->input('search');

        // 検索ワードが入力されていたら
        if($search !== null) {

            // 検索ワードに部分一致するユーザーをすべて取得
            $users = $user->getSearchUsers($user_id, $search);

        } else {

            // すべてのユーザーを取得
            $users = $user->getAllUsers(auth()->user()->id);
        }

        return view('users.index', compact(
            'users',
            'default_image',
            'login_user',
            'search'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $timelines = $review->getUserTimeLine($user->id);
        $review_count = $review->getReviewCount($user->id);
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);
        $favorite_reviews_count = $review->getFavoriteReviews($user->id)->count();
        $default_image = asset('storage/profile_image/Default_User_Icon.jpeg');



        return view('users.show', compact(
            'user',
            'login_user',
            'is_following',
            'is_followed',
            'timelines',
            'review_count',
            'follow_count',
            'follower_count',
            'favorite_reviews_count',
            'default_image'
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
            $default_image = asset('storage/profile_image/Default_User_Icon.jpeg');

        return view('users.edit', compact(
            'login_user',
            'default_image'

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
            'description'   => ['string', 'max:200'],
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

        // ログアウトは不要？
        // Auth::logout();
        $login_user->delete();

        // ホーム画面へリダイレクト
        return redirect('/');

    }

    // フォローする
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }

    // フォローしている全ユーザー
    public function following(User $user, Review $review, Follower $follower)
    {
        $following_users = $user->getFollowingUsers($user->id);
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $review_count = $review->getReviewCount($user->id);
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);
        $favorite_reviews_count = $review->getFavoriteReviews($user->id)->count();
        $default_image = asset('storage/profile_image/Default_User_Icon.jpeg');

        return view('users.following', compact(
            'following_users',
            'user',
            'login_user',
            'is_following',
            'is_followed',
            'review_count',
            'follow_count',
            'follower_count',
            'favorite_reviews_count',
            'default_image'
        ));
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
        $default_image = asset('storage/profile_image/Default_User_Icon.jpeg');

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
            'default_image'
        ));
    }

    // いいねした投稿
    public function favorite(User $user, Review $review, Follower $follower)
  {
    $timelines = $review->getFavoriteReviews($user->id);
    $login_user = auth()->user();
    $is_following = $login_user->isFollowing($user->id);
    $is_followed = $login_user->isFollowed($user->id);
    $review_count = $review->getReviewCount($user->id);
    $follow_count = $follower->getFollowCount($user->id);
    $follower_count = $follower->getFollowerCount($user->id);
    $favorite_reviews_count = $review->getFavoriteReviews($user->id)->count();
    $default_image = asset('storage/profile_image/Default_User_Icon.jpeg');

    return view('users.favorite', compact(
        'user',
        'login_user',
        'is_following',
        'is_followed',
        'timelines',
        'review_count',
        'follow_count',
        'follower_count',
        'favorite_reviews_count',
        'default_image'
    ));
  }

}
