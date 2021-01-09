<?php

namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\User;

class HttpPostStatusTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    private $attributes;

    public function setUp(): void
    {
        parent::setUp();

        // データベースマイグレーション
        $this->artisan('migrate');

        // テストデータ挿入
        $this->seed('UsersTableSeeder');
        $this->seed('ReviewsTableSeeder');
    }

    public function testPostStatus()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/api/reviews/post?asin=B07LG7TG5N');
        $response->assertStatus(200);
    }
}
