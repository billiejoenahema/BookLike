<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SearchItems;
use App\Http\Controllers\Controller;

class SearchItemsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, SearchItems $searchitems)
    {
        $login_user = auth()->user();
        $keyword = $request->input('keyword');

        // 有効な検索ワードが入力されているかどうかをチェック
        $search_word = str_replace('\\', '', $keyword);
        if(!$search_word) return back();

        $search_items = $searchitems->getSearchItems($search_word);
        $storage = Storage::disk('s3');

        return view('reviews.search_items', compact(
            'search_items',
            'login_user',
            'keyword',
            'storage'
        ));
    }
}
