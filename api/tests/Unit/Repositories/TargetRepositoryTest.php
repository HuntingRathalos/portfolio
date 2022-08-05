<?php

namespace Tests\Unit\Repositories;

use App\Models\Target;
use App\Models\User;
use App\Repositories\Target\TargetRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TargetRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        //  依存解決しながらリポジトリ取得
        $this->repo = $this->app->make(TargetRepository::class);
    }

    public function testGetTargetById()
    {
        // IDを指定したレコードをあらかじめ作成
        $targetId = 50;
        Target::factory()->create([
            'id' => $targetId,
        ]);

        $target = $this->repo->getTargetById($targetId);

        // getTargetByIdの返り値がTargetインスタンスであることを確認
        $this->assertInstanceOf(Target::class, $target);
    }

    public function testCreateTarget()
    {
        // 認証済みユーザー作成
        $user = User::factory()->create();
        $this->actingAs($user);

        // 新しい目標作成用データ作成
        $targetDetails = [
            'user_id' => $user->id,
            'name' => 'パソコンを買う',
            'amount' => 80000,
        ];
        $createdTarget = $this->repo->createTarget($targetDetails);

        // DBに保存されていることを確認
        $this->assertDatabaseHas('targets', $targetDetails);
        $this->assertInstanceOf(Target::class, $createdTarget);
    }

    public function testUpdateTarget()
    {
        // IDを指定したレコードをあらかじめ作成
        $targetId = 100;
        Target::factory()->create([
            'id' => $targetId,
        ]);

        // 記録更新用データ作成
        $targetDetails = [
            'name' => '旅行に行きたい!!',
        ];
        $updatedTarget = $this->repo->updateTarget($targetId, $targetDetails);

        // DBに更新済みレコードが保存されていること、返り値がtrueであることを確認
        $this->assertDatabaseHas('targets', $targetDetails);
        $this->assertSame($updatedTarget, true);
    }

    public function testDeleteTarget()
    {
        // IDを指定したレコードをあらかじめ作成
        $targetId = 200;
        Target::factory([
            'id' => $targetId,
        ]);
        $this->repo->deleteTarget($targetId);

        // 指定したIDのレコードがDBに存在しないことを確認
        $this->assertDatabaseMissing('targets', [
            'id' => $targetId,
        ]);
    }
}
