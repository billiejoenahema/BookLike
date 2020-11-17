<?php

namespace Tests\Unit;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

class UserTest extends TestCase
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
    }

    public function test_createUser()
    {
        // require('App\Models\User.php');
        $user = new User;

        $user = User::create([
            'screen_name'    => 'TestUser',
            'name'           => 'テスト ユーザー',
            'description'    => 'TestUser Profile',
            'email'          => 'testuser@example.com',
            'password'       => Hash::make('testuser+password'),
            'remember_token' => Str::random(10),
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        $this->assertEquals(2, User::all()->count());
        $this->assertDatabaseHas('users', ['screen_name' => 'TestUser']);
    }

}
