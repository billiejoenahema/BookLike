<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * コメントを登録する。
     *
     * @param  StoreCommentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCommentRequest $request)
    {
        $loginUser = Auth::user();

        $comment = DB::transaction(function () use ($loginUser, $request) {
            $comment = Comment::create([
                'user_id' => $loginUser->id,
                'review_id' => $request['review_id'],
                'text' => $request['text'],
                'user_id' => $request['user_id'],
            ]);
            return $comment;
        });
        if(isEmpty($comment)) {
            session()->flash('flash_message', 'コメントの投稿に失敗しました');
        } else {
            session()->flash('flash_message', 'コメントを投稿しました');
        }

        return back();
    }

    /**
     * コメントを削除する。
     *
     * @param  Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment)
    {
        $comment->where('id', $comment->id)->delete();
        session()->flash('flash_message', 'コメントを削除しました');

        return back();
    }
}
