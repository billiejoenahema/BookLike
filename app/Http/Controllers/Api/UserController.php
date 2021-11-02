<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array<string, mixed>
     */
    public function index(Request $request)
    {
        $pagination = config('PAGINATION.USERS');
        $user = new User;
        $sort = $request['sort'];
        $loginUserId = auth()->user()->id;
        // 並び替えられたユーザー一覧を取得
        $users = $user->sortedUsers($sort, $pagination, $loginUserId);

        return UserResource::collection($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @return array<mixed>
     */
    public function show(Request $request)
    {
        $id = (int) $request->user;
        $query = User::with([
            'follows',
            'followers',
            'reviews' => function ($query) {
                return $query->withCount('favorites');
            }
        ])
            ->withCount([
                'follows',
                'followers',
                'reviews'
            ]);

        $user = $query->findOrFail($id);

        return new UserResource($user);
    }
}
