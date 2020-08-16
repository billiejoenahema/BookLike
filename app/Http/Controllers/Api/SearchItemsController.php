<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\SearchItems;
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
        $keyword = $request->input('keyword');
        dd($keyword);

        $login_user = auth()->user();
        $default_image = asset('storage/profile_image/Default_User_Icon.jpeg');

        $search_items = $searchitems->getSearchItems($keyword);
        // とりあえず最初に検索にヒットした書籍のタイトルを表示させる
        $title = $search_items[0]->ItemInfo->Title->DisplayValue;

        return view('reviews.create', compact(
            'title',
            'login_user',
            'default_image'
        ));
    }
}
