<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCommentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = new Comment;
        $user = auth()->user();
        $data = $request->all();
        $comment->commentStore($user->id, $data);
        session()->flash('flash_message', 'コメントを投稿しました');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment)
    {
        $comment->commentDestroy($comment->id);
        session()->flash('flash_message', 'コメントを削除しました');

        return back();
    }
}