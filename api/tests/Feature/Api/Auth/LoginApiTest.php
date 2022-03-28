<?php

namespace Tests\Feature\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // テストユーザー作成
        $this->user = User::factory()->create();
    }
    /**
     * @test
     */
    public function 登録済みのユーザー情報でログインできる()
    {
        // ログイン処理
        $response = $this->json('POST', '/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);

        // 認証されていることを確認
        $this->assertAuthenticatedAs($this->user);

    }
}
