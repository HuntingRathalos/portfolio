<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutApiTest extends TestCase
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
    public function 認証済みユーザーをログアウトさせる()
    {
        $response = $this->actingAs($this->user)
            ->json('POST', '/api/logout');

        $response->assertStatus(204);
        $this->assertGuest();
    }
}
