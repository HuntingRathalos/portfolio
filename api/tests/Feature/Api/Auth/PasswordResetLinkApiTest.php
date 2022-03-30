<?php

namespace Tests\Feature\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class PasswordResetLinkApiTest extends TestCase
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
    public function パスワードリセットリンク付きメールを送信できる()
    {
        // テスト時、実際にはメール送信しない
        Notification::fake();

        $response = $this->json('POST', '/api/forgot-password', [
            'email' => $this->user->email
        ]);

        $response->assertStatus(200);

        // メール送信処理
        Notification::assertSentTo(
            $this->user,
            ResetPassword::class
        );
    }
}
