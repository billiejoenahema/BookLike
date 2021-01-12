<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use App\Models\Review;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Review::class, function (Faker $faker) {

    $categories = ['文学', 'エンターテインメント', 'ミステリー', 'SF', 'ホラー', 'ファンタジー', '青春・恋愛', '歴史・時代', 'ノンフィクション', 'ビジネス・経済', 'コンピュータ・IT', 'コミック', 'ライトノベル', 'その他'];

    return [
        'user_id' => function(){
            return factory(User::class)->create()->id;
        },
        'category' => $faker->randomElement($categories),
        'asin' => Str::random(8),
        'page_url' => $faker->url(),
        'title' => Str::random(10),
        'author' => Str::random(10),
        'manufacturer' => Str::random(10),
        'image_url' => $faker->url(),
        'text' => Str::random(10),
    ];
});
