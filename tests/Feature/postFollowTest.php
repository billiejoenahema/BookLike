<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;


class postFollowTest extends TestCase
{
    use RefreshDatabase;

    public function testPostFollow()
    {
        $userA = factory(User::class)->create();
        $userB = factory(User::class)->create();

        // フォロー
        $response = $this->actingAs($userA);
        $response->post('/api/follow/'.$userB->id);
        $response->assertDatabaseHas('followers', [
            'followed_id' => $userB->id,
        ]);

        // フォロー解除
        $response->post('/api/unfollow/'.$userB->id);
        $response->assertDatabaseMissing('followers', [
            'followed_id' => $userB->id,
        ]);
    }
}
