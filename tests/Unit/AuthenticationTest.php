<?php

namespace Tests\Unit;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $password = 'password';

    public function setUp(): void
    {
        parent::setUp();

        // テストユーザ作成
        $this->user = factory(User::class)->create([
            'password' => bcrypt($this->password)
        ]);
    }

    public function testLogin(): void
    {
        // 認証リクエスト
        $response = $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => $this->password,
        ]);

        // リクエスト送信後、正しいくリダイレクト処理されていることを確認
        $response->assertRedirect('/reviews');

        // 指定したユーザーが認証されていることを確認
        $this->assertAuthenticatedAs($this->user);
    }

    public function testLogout(): void
    {
        $response = $this->actingAs($this->user);

        $response->post(route('logout'));

        // ユーザーが認証されていないことを確認
        $this->assertGuest();
    }
}
