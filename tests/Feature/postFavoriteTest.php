<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Review;

class postFavoriteTest extends TestCase
{
    use RefreshDatabase;

    public function testPostFavorite()
    {
        $user = factory(User::class)->create();
        $review = factory(Review::class)->create();

        // いいね
        $response = $this->actingAs($user);
        $response->post('/api/add_favorite/'.$review->id);
        $response->assertDatabaseHas('favorites', [
            'review_id' => $review->id,
        ]);

        // いいね解除
        $response->delete('/api/remove_favorite/'.$review->id);
        $response->assertDatabaseMissing('favorites', [
            'alert_id' => $review->id,
        ]);
    }
}
