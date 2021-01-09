<?php

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Review::create([
                'user_id'      => 1,
                'category'     => 'SF',
                'asin'         => 'B00O1VJZLO',
                'page_url'     => 'https://www.amazon.co.jp/dp/B00O1VJZLO?tag=billiejoenahe-22&linkCode=ogi&th=1&psc=1',
                'title'        => '火星の人',
                'author'       => 'アンディ ウィアー',
                'manufacturer' => '早川書房',
                'image_url'    => 'https://m.media-amazon.com/images/I/51DLzSbrC9L.jpg',
                'text'         => 'テスト投稿',
                'created_at'   => now(),
                'updated_at'   => now()
            ]);
    }
}
