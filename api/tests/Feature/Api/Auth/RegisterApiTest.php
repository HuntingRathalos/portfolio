<?php

namespace Tests\Feature\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegisterApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function  会員登録に成功する()
    {
        $data = [
            'name' => 'TestUser',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // 会員登録処理
        $response = $this->json('POST', '/register', $data);
        
        // DBに保存されていることを確認
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email']
        ]);

        $response->assertStatus(201);

        // 登録後自動ログインさせないため、認証されていないことを確認
        $this->assertGuest();
    }
}
