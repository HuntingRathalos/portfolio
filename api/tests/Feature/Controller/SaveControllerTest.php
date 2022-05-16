<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Save;

class SaveControllerTest extends TestCase
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
      ->json('GET', route('saves.index'));

    $response->assertStatus(200);
  }

  public function testGetAllSavesAmount()
  {
    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('GET', '/api/saves/amount');

    $response->assertStatus(200);
  }

  public function testGetSavesOneWeek()
  {
    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('GET', '/api/saves/week');

    $response->assertStatus(200);
  }

  public function testGetSaveRanking()
  {
    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
    ->json('GET', '/api/saves/ranking');

    $response->assertStatus(200);
  }

  public function testStore()
  {
    // レコード作成用データ
    $data = [
      'user_id' => $this->user->id,
      'tag_id' => 1,
      'icon_id' => 2,
      'coin' => 3,
      'memo' => '一日一枚',
      'click_date' => '2022-4-22',
    ];

    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('POST', route('saves.store'), $data);

    // レスポンスに指定dataが含まれていることを確認
    $response->assertStatus(201)
      ->assertJsonFragment($data);
  }

  public function testUpdate()
  {
    // テスト用レコード作成
    $save = Save::factory()->create([
      'user_id' => $this->user->id
    ]);

    // 既存レコードの一部を更新するデータ
    $data = [
      'id' => $save->id,
      'user_id' => $this->user->id,
      'tag_id' => $save->tag_id,
      'icon_id' => $save->icon_id,
      'coin' => $save->coin,
      'memo' => '毎日頑張るよ',
      'click_date' => '2022-05-16',
    ];

    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('PATCH', route('saves.update',['save' => $save->id]), $data);

    // レスポンスに指定dataが含まれていることを確認
    $response->assertStatus(201)
      ->assertJsonFragment(['memo' => '毎日頑張るよ',
      'click_date' => '2022-05-16',]);
  }

  public function testDestroy()
  {
     // テスト用レコード作成
     $save = Save::factory()->create([
      'user_id' => $this->user->id
    ]);

    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
    ->json('delete', route('saves.destroy', ['save' => $save->id]), [
      'id' => $save->id
    ]);

    $response->assertStatus(204);
  }
}
