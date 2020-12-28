<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Review;
use App\Http\Controllers\Api\GetItem;
use DateTime;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(User $user)
    {
        $login_user = auth()->user();
        $storage = Storage::disk('s3');

        return view('users.index', compact(
            'login_user',
            'storage'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, GetItem $get_item)
    {
        $login_user = auth()->user();
        $storage = Storage::disk('s3');
        $created_at = new DateTime($user->created_at);
        $updated_at = new DateTime($user->updated_at);
        $create_date = $created_at->format('Y-m-d');
        $update_date = $updated_at->format('Y-m-d');

        if ($user === $login_user) {
            $asin = $login_user->asin;
        } else {
            $asin = $user->asin;
        }

        if ($asin) {
            $item = $get_item->getItem($asin);
            $book_image = $item->Images->Primary->Large->URL;
            $book_url = $item->DetailPageURL;
        } else {
            // default book_image&book_url
            $book_image = 'https://s3-ap-northeast-1.amazonaws.com/www.booklikeapp.com/default_book_image.png';
            $book_url = '#';
        }

        return view('users.show', compact(
            'user',
            'login_user',
            'create_date',
            'update_date',
            'book_image',
            'book_url',
            'storage'
        ));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(User $user, Review $review)
        {
            $login_user = auth()->user();
            $storage = Storage::disk('s3');
            $userReviews = $review->where('user_id', $user->id)
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('users.edit', compact(
            'login_user',
            'storage',
            'userReviews'
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
            'name'          => ['nullable', 'string', 'max:50'],
            'profile_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'category'      => ['string', 'max:255'],
            'asin'          => ['string', 'max:10'],
            'story'         => ['string', 'max:800'],
            'description'   => ['string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);
        $validator->validate();
        $user->updateProfile($data);
        session()->flash('flash_message', 'プロフィールを編集しました');

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

}
