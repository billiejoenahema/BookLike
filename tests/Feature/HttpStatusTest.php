<?php

namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class HttpStatusTest extends TestCase
{
    use RefreshDatabase;

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

    public function testIndexStatus()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testReviewsStatus()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/reviews');
        $response->assertStatus(200);
    }

    public function testReviewsShowStatus()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/reviews/1');
        $response->assertStatus(200);
    }

    public function testUsersStatus()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/users');
        $response->assertStatus(200);
    }

    public function testUsersShowStatus()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/users/1');
        $response->assertStatus(200);
    }

    public function testUsersEditStatus()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/users/1/edit');
        $response->assertStatus(200);
    }

    public function testTermsStatus()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/terms');
        $response->assertStatus(200);
    }

    public function testPrivacyStatus()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/privacy');
        $response->assertStatus(200);
    }

    public function testSearchItemsStatus()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/api/reviews/search_items?keyword=factfulness');
        $response->assertStatus(200);
    }

}
