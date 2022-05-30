<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use DateTime;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        $product = new Product;
        $created_at = new DateTime($user->created_at);
        $updated_at = new DateTime($user->updated_at);
        $create_date = $created_at->format('Y/m/d');
        $update_date = $updated_at->format('Y/m/d');

        // デフォルト値
        $book = (object) [
            'image' => 'https://s3-ap-northeast-1.amazonaws.com/www.booklikeapp.com/default_book_image.png',
            'url' => 'https://amzn.to/3o6eEow',
            'title' => 'タイトル',
        ];

        if ($user->asin) {
            $item = $product->getItem($user->asin);
            $book->image = $item->Images->Primary->Large->URL;
            $book->url = $item->DetailPageURL;
            $book->title = $item->ItemInfo->Title->DisplayValue;
        }


        return view('users.show', compact(
            'user',
            'create_date',
            'update_date',
            'book',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $review = new Review;
        $product = new Product;
        $userReviews = $review->getUserReviews($user->id);
        $selected_book_title = '未設定';
        if ($user->asin) {
            $user_book = $product->getItem($user->asin);
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
     * @param  UpdateUserRequest  $request
     * @param  User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($user->id === 1) {
            return redirect('users/' . $user->id)
                ->with('error', 'ゲストユーザー はプロフィールを編集できません');
        }
        $user->updateProfile($request);
        session()->flash('flash_message', 'プロフィールを編集しました');

        return redirect('users/' . $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        if ($user->id === 1) {
            return redirect('users/' . $user->id)
                ->with('error', 'ゲストユーザー はアカウントを削除できません');
        }
        $login_user = auth()->user();
        $login_user->delete();

        return redirect('/');
    }
}
