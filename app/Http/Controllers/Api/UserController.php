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
        $query = User::with(['follows', 'followers', 'reviews'])
            ->withCount(['follows', 'followers', 'reviews'])
            ->where('id', '!=', auth()->user()->id);
        $pagination = config('PAGINATION.USERS');

        // ソート
        switch ($request['sort']) {
            case 'review':
                // いいね獲得数順
                $query->orderBy('reviews_count', 'DESC');
            case 'follower':
                // フォロワーが多い順
                $query->orderBy('followers_count', 'DESC');
            case 'favorite':
                // いいね獲得数順
                $query->orderBy('favorites_count', 'DESC');
            case 'default':
            default:
                $query->orderBy('created_at', 'DESC');
        }
        $users = $query->paginate($pagination);

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