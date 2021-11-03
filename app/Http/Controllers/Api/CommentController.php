<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        $user = auth()->user();
        $data = $request->all();

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->review_id = $data['review_id'];
        $comment->text = $data['text'];
        $comment->save();
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
        $comment->where('id', $comment->id)->delete();
        session()->flash('flash_message', 'コメントを削除しました');

        return back();
    }
}