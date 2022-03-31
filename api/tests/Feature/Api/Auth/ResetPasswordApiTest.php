<?php

namespace Tests\Feature\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function パスワードリセットリンク付きメールを送信できる()
    {
        // テスト時、実際にはメール送信しない
        Notification::fake();

        // テストユーザー作成
        $user = User::factory()->create();

        $response = $this->json('POST', '/api/forgot-password', [
            'email' => $user->email
        ]);

        $response->assertStatus(200);

        $token = '';

        // メール送信処理
        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            function ($notification) use (&$token) {
                $token = $notification->token;
                return true;
            }
        );

        $newPassword = 'password10';

        // パスワードリセット処理
        $response = $this->json('POST', '/api/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]);

        $response->assertStatus(200);

        // DBからモデルを再取得
        $freshUser = $user->fresh();
        // 更新後のパスワードが保存されていることを確認
        $this->assertTrue(Hash::check($newPassword, $freshUser->password));

    }
}
