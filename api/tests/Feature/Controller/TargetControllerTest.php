<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Target;


class TargetControllerTest extends TestCase
{
  use RefreshDatabase;

  public function setUp(): void
  {
      parent::setUp();

      // テストユーザー作成
      $this->user = User::factory()->create();
  }

  public function testIndex()
  {
     // 認証済みユーザーとしてアクセス
     $response = $this->actingAs($this->user)
      ->json('GET', route('targets.index'));

    $response->assertStatus(200);
  }

  public function testStore()
  {
    // レコード作成用データ
    $data = [
      'user_id' => $this->user->id,
      'name' => '本を買う',
      'amount' => 30000,
    ];

    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('POST', route('targets.store'), $data);

    // レスポンスに指定dataが含まれていることを確認
    $response->assertStatus(201)
      ->assertJsonFragment($data);
  }

  public function testUpdate()
  {
    // テスト用レコード作成
    $target = Target::factory()->create([
      'user_id' => $this->user->id
    ]);

    // 既存レコードの一部を更新するデータ
    $data = [
      'user_id' => $this->user->id,
      'name' => '旅行',
      'amount' => $target->amount,
    ];

    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('PATCH', route('targets.update', ['target' => $target->id]), $data);

    $response->assertStatus(201)
      ->assertJsonFragment([
      'name' => '旅行',
      ]);
  }

  public function testDestroy()
  {
    // テスト用レコード作成
    $target = Target::factory()->create([
      'user_id' => $this->user->id
    ]);
    
    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('delete', route('targets.destroy', ['target' => $target->id], [
        'id' => $target->id
      ]));

    $response->assertStatus(204);
  }
}
