<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $comment = new Comment;
        $user = auth()->user();
        $data = $request->all();
        $validator = Validator::make($data, [
            'review_id' => 'required | integer',
            'text'     => 'required | string | max:200'
        ]);

        $validator->validate();
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