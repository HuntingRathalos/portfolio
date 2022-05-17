<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Save;
use App\Repositories\Save\SaveRepositoryInterface;
use App\Repositories\Save\SaveRepository;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Mockery;


class SaveControllerTest extends TestCase
{
  use RefreshDatabase;

  private $saveRepositoryMock;

  public function setUp(): void
  {
      parent::setUp();

      // 依存しているリポジトリのモック作成
      $this->saveRepositoryMock = Mockery::mock(SaveRepository::class);
      $this->app->instance(SaveRepositoryInterface::class, $this->saveRepositoryMock);

      // テストユーザー作成
      $this->user = User::factory()->make([
        'id' => 1
      ]);
  }

  public function testIndex()
  {
    // モックの戻り値作成
    $data = new Collection(Save::factory()->count(5)->make());

    // SaveRepositoryのgetAllSavesをモック
    $this->saveRepositoryMock->shouldReceive('getAllSaves')
    ->once()
    ->andReturn($data);

    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('GET', route('saves.index'));

    $response->assertStatus(200);
  }

  public function testGetAllSavesAmount()
  {
    // モックの戻り値作成
    $data = new Collection(
      Save::factory()->count(3)->make([
      'coin' => 3
    ]));

    // SaveRepositoryのgetAllSavesをモック
    $this->saveRepositoryMock->shouldReceive('getAllSaves')
    ->once()
    ->andReturn($data);

    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('GET', '/api/saves/amount');

    $response->assertStatus(200);
  }

  public function testGetSavesOneWeek()
  {
    // 週初、週末の日付をdate型で取得
    // $clickedDate = new Carbon();
    $cb1 = new Carbon();
    $dateFromThisWeek = $cb1->startOfWeek()->toDateString();
    $cb2 = new Carbon();
    $dateToThisWeek = $cb2->endOfWeek()->toDateString();

    // モックの戻り値作成
    $data = new Collection(
      Save::factory()->count(2)->make([
      'click_date' => '2022-05-16'
    ]));

    // SaveRepositoryのgetSavesSpecificPeriodをモック
    $this->saveRepositoryMock->shouldReceive('getSavesSpecificPeriod')
      ->once()
      ->with($dateFromThisWeek, $dateToThisWeek)
      ->andReturn($data);

    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('GET', '/api/saves/week');

    $response->assertStatus(200);
  }

  // public function testGetSaveRanking()
  // {
  //   // 認証済みユーザーとしてアクセス
  //   $response = $this->actingAs($this->user)
  //   ->json('GET', '/api/saves/ranking');

  //   $response->assertStatus(200);
  // }

  public function testStore()
  {
    // モックの引数(レコード作成用データ)作成
    $saveDetails = [
      'user_id' => $this->user->id,
      'tag_id' => 1,
      'icon_id' => 2,
      'coin' => 3,
      'memo' => '一日一枚',
      'click_date' => '2022-4-22',
    ];
    // SaveRepositoryのcreateSaveをモック
    $this->saveRepositoryMock->shouldReceive('createSave')
      ->once()
      ->with(Mockery::on(function($saveDetailsArray) use ($saveDetails) {
          $this->assertSame($saveDetailsArray, $saveDetails)
            && is_array($saveDetailsArray);
          return true;
      }))
      ->andReturn(Save::factory()->make($saveDetails));

    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('POST', route('saves.store'), $saveDetails);

    // レスポンスに指定dataが含まれていることを確認
    $response->assertStatus(201)
      ->assertJsonFragment($saveDetails);
  }

  public function testUpdate()
  {
    // テスト用レコード作成
    $save = Save::factory()->make([
      'id' => 1,
      'user_id' => $this->user->id
    ]);
    // モックの引数作成
    $saveId = $save->id;
    // 既存レコードの一部を更新するデータ
    $saveDetails = [
      'id' => $save->id,
      'user_id' => $this->user->id,
      'tag_id' => $save->tag_id,
      'icon_id' => $save->icon_id,
      'coin' => $save->coin,
      'memo' => '毎日頑張るよ',
      'click_date' => '2022-05-16',
    ];

    // SaveRepositoryのupdateSaveをモック
    $this->saveRepositoryMock->shouldReceive('updateSave')
      ->once()
      ->with($saveId, Mockery::on(function($saveDetailsArray) use ($saveDetails) {
          $this->assertSame($saveDetailsArray, $saveDetails)
            && is_array($saveDetailsArray);
          return true;
      }))
      ->andReturn(true);

    // SaveRepositoryのgetSaveByIdをモック
    $this->saveRepositoryMock->shouldReceive('getSaveById')
    ->once()
    ->with($saveId)
    ->andReturn(Save::factory()->make($saveDetails));

    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('PATCH', route('saves.update',['save' => $saveId]), $saveDetails);

    // レスポンスに指定dataが含まれていることを確認
    $response->assertStatus(201)
      ->assertJsonFragment(['memo' => '毎日頑張るよ',
      'click_date' => '2022-05-16']);
  }

  public function testDestroy()
  {
    // テスト用レコード作成
    $save = Save::factory()->make([
     'id' => 2,
     'user_id' => $this->user->id
   ]);

    // モックの引数作成
    $saveId = $save->id;
    // SaveRepositoryのdeleteSaveをモック
    $this->saveRepositoryMock->shouldReceive('deleteSave')
      ->once()
      ->with($save->id)
      ->andReturnNull();


    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
    ->json('delete', route('saves.destroy', ['save' => $save->id]), [
      'id' => $save->id
    ]);

    $response->assertStatus(204);
  }
}
