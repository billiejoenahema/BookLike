<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Review;

class postReviewTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testPostReview()
    {
        $categories = ['文学', 'エンターテインメント', 'ミステリー', 'SF', 'ホラー', 'ファンタジー', '青春・恋愛', '歴史・時代', 'ノンフィクション', 'ビジネス・経済', 'コンピュータ・IT', 'コミック', 'ライトノベル', 'その他'];
        $category = array_rand($categories, 1);
        $asin = '4822289605';
        $page_url = 'https://www.amazon.co.jp/dp/B07LG7TG5N?tag=billiejoenahe-22&linkCode=ogi&th=1&psc=1';
        $title = 'FACTFULNESS（ファクトフルネス）10の思い込みを乗り越え、データを基に世界を正しく見る習慣';
        $author = 'ハンス・ロスリング';
        $manufacturer = '日経BP';
        $image_url = 'https://m.media-amazon.com/images/I/410QuKHYY3L.jpg';
        $ratings = rand(1, 5);
        $spoiler = rand(0, 1);
        $text = $this->faker->realText(800);

        $user = factory(User::class)->create();
        $review = factory(Review::class)->create();

        $review->user_id = $user->id;
        $review->category = $category;
        $review->asin = $asin;
        $review->page_url = $page_url;
        $review->title = $title;
        $review->author = $author;
        $review->manufacturer = $manufacturer;
        $review->image_url = $image_url;
        $review->ratings = $ratings;
        $review->spoiler = $spoiler;
        $review->text = $text;
        $review->save();

        $this->assertDatabaseHas('reviews', ['asin' => $asin]);
        $this->assertDatabaseHas('reviews', ['page_url' => $page_url]);
        $this->assertDatabaseHas('reviews', ['title' => $title]);
        $this->assertDatabaseHas('reviews', ['author' => $author]);
        $this->assertDatabaseHas('reviews', ['manufacturer' => $manufacturer]);
        $this->assertDatabaseHas('reviews', ['image_url' => $image_url]);
        $this->assertDatabaseHas('reviews', ['ratings' => $ratings]);
        $this->assertDatabaseHas('reviews', ['spoiler' => $spoiler]);
        $this->assertDatabaseHas('reviews', ['text' => $text]);

    }


}
