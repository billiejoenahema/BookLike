<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\GetItem;
use DateTime;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, GetItem $get_item)
    {
        $created_at = new DateTime($user->created_at);
        $updated_at = new DateTime($user->updated_at);
        $create_date = $created_at->format('Y/m/d');
        $update_date = $updated_at->format('Y/m/d');
        $asin = $user->asin;

        // デフォルト値
        $book_image = 'https://s3-ap-northeast-1.amazonaws.com/www.booklikeapp.com/default_book_image.png';
        $book_url = 'https://amzn.to/3o6eEow';
        $book_title = 'タイトル';

        if ($asin) {
            $item = $get_item->getItem($asin);
            $book_image = $item->Images->Primary->Large->URL;
            $book_url = $item->DetailPageURL;
            $book_title = $item->ItemInfo->Title->DisplayValue;
        }

        return view('users.show', compact(
            'user',
            'create_date',
            'update_date',
            'book_image',
            'book_url',
            'book_title',
        ));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(User $user, Review $review, GetItem $get_item)
        {
            $userReviews = $review->getUserReviews($user->id);
            $selected_book_title = '未設定';
            if($user->asin) {
                $user_book = $get_item->getItem($user->asin);
                $selected_book_title = $user_book->ItemInfo->Title->DisplayValue;
            }

        return view('users.edit', compact(
            'userReviews',
            'selected_book_title',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        if ($user->id === 1) {
            return redirect('users/'.$user->id)
                ->with('error', 'ゲストユーザー はプロフィールを編集できません');
        }
        $user->updateProfile($request);
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
        if ($user->id === 1) {
            return redirect('users/'.$user->id)
                ->with('error', 'ゲストユーザー はアカウントを削除できません');
        }
        $login_user = auth()->user();
        $login_user->delete();

        return redirect('/');
    }

}
