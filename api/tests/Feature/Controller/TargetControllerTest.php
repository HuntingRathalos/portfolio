<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repositories\Target\TargetRepositoryInterface;
use App\Repositories\Target\TargetRepository;
use App\Models\User;
use App\Models\Target;
use Mockery;


class TargetControllerTest extends TestCase
{
  use RefreshDatabase;

  private $targetRepositoryMock;

  public function setUp(): void
  {
      parent::setUp();

      // 依存しているリポジトリのモック作成
      $this->targetRepositoryMock = Mockery::mock(TargetRepository::class);
      $this->app->instance(TargetRepositoryInterface::class, $this->targetRepositoryMock);

      // テストユーザー作成
      $this->user = User::factory()->make([
        'id' => 1
      ]);
  }

  public function testIndex()
  {
    // TargetRepositoryのgetTargetをモック
    $this->targetRepositoryMock->shouldReceive('getTarget')
    ->once()
    ->andReturn(Target::factory()->make([
      'name' => '旅行',
      'amount' => 30000
    ]));
     // 認証済みユーザーとしてアクセス
     $response = $this->actingAs($this->user)
      ->json('GET', route('targets.index'));

    $response->assertStatus(200)
      ->assertJsonFragment([
        'name' => '旅行',
        'amount' => 30000
      ]);
  }

  public function testStore()
  {
    // モックの引数(レコード作成用データ)作成
    $targetDetails = [
      'name' => '本を買う',
      'amount' => 30000,
    ];
    // TargetRepositoryのcreateTargetをモック
    $this->targetRepositoryMock->shouldReceive('createTarget')
      ->once()
      ->with(Mockery::on(function($targetDetailsArray) use ($targetDetails) {
          $this->assertSame($targetDetailsArray, $targetDetails)
            && is_array($targetDetailsArray);
          return true;
      }))
      ->andReturn(Target::factory()->make($targetDetails));

    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('POST', route('targets.store'), $targetDetails);

    // レスポンスに指定dataが含まれていることを確認
    $response->assertStatus(201)
      ->assertJsonFragment($targetDetails);
  }

  public function testUpdate()
  {
    // テスト用レコード作成
    $target = Target::factory()->make([
      'id' => 1,
      'user_id' => $this->user->id
    ]);
    // モックの引数作成
    $targetId = $target->id;
    // 既存レコードの一部を更新するデータ
    $targetDetails = [
      'name' => '旅行',
      'amount' => $target->amount,
    ];

    // TargetRepositoryのupdateTargetをモック
    $this->targetRepositoryMock->shouldReceive('updateTarget')
      ->once()
      ->with($targetId, Mockery::on(function($targetDetailsArray) use ($targetDetails) {
          $this->assertSame($targetDetailsArray, $targetDetails)
            && is_array($targetDetailsArray);
          return true;
      }))
      ->andReturn(true);

     // TargetRepositoryのgetTargetByIdをモック
     $this->targetRepositoryMock->shouldReceive('getTargetById')
       ->once()
       ->with($targetId)
       ->andReturn(Target::factory()->make($targetDetails));


    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('PATCH', route('targets.update', ['target' => $targetId]), $targetDetails);

    // レスポンスに指定dataが含まれていることを確認
    $response->assertStatus(201)
      ->assertJsonFragment($targetDetails);
  }

  public function testDestroy()
  {
    // テスト用レコード作成
    $target = Target::factory()->make([
      'id' => 1,
      'user_id' => $this->user->id
    ]);
    // モックの引数作成
    $targetId = $target->id;

    // TargetRepositoryのdeleteTargetをモック
    $this->targetRepositoryMock->shouldReceive('deleteTarget')
      ->once()
      ->with($targetId)
      ->andReturnNull();

    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('delete', route('targets.destroy', ['target' => $targetId], [
        'id' => $targetId
      ]));

    $response->assertStatus(204);
  }
}
