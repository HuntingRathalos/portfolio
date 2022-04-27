<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Models\Save;
use App\Models\User;
use App\Repositories\Save\SaveRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class SaveRepositoryTest extends TestCase
{
  use RefreshDatabase;

  public function setUp(): void
  {
      parent::setUp();

      //  依存解決しながらリポジトリ取得
      $this->repo = $this->app->make(SaveRepository::class);
  }

  public function testGetSavesOneMonth()
  {
    // 今月の月初、月末、来月の月初の日付をdate型で取得
    $cb = new Carbon();
    $dateFromThisMonth = $cb->startOfMonth()->toDateString();
    $cb2 = new Carbon();
    $dateFromNextMonth = $cb2->startOfMonth()->addMonth()->toDateString();
    $cb3 = new Carbon();
    $dateToThisMonth = $cb3->endOfMonth()->toDateString();

    // 今月のレコードを２つ作成
    $save_ok = Save::factory()->count(2)->create([
      'click_date' => $dateFromThisMonth,
    ]);
    // 来月のレコードを１つ作成
    $save_ng = Save::factory()->create([
      'click_date' => $dateFromNextMonth,
    ]);
    $saves = $this->repo->getSavesOneMonth($dateFromThisMonth, $dateToThisMonth);

    // 1ヶ月間(今月分)のレコードを取得し、数が２つであることを確認する
    $recordNum = $saves->count();
    $this->assertSame(2, $recordNum);
  }


  public function testCreateSave()
  {
    $user = User::factory()->create();
    $this->actingAs($user);

    // 新しい貯金記録作成用データ作成
    $saveDetails = [
      'user_id' => $user->id,
      'tag_id' => 2,
      'icon_id' => 3,
      'coin' => 1,
      'memo' => '今日も一枚貯金したよ',
      'click_date' => '2022-4-20',
    ];
    $createdSave = $this->repo->createSave($saveDetails);

    // DBに保存されていることを確認
    $this->assertDatabaseHas('saves', $saveDetails);
    $this->assertInstanceOf(Save::class, $createdSave);
  }

  public function testUpdateSave()
  {
    // IDを指定したレコードをあらかじめ作成
    $saveId = 100;
    Save::factory()->create([
      'id' => $saveId,
    ]);

    // 記録更新用データ作成
    $saveDetails = [
      'memo' => '毎日貯金する',
    ];
    $updatedSave = $this->repo->updateSave($saveId, $saveDetails);

    // DBに更新済みレコードが保存されていること、返り値がtrueであることを確認
    $this->assertDatabaseHas('saves', $saveDetails);
    $this->assertSame($updatedSave, true);
  }

  public function testDeleteSave()
  {
    // IDを指定したレコードをあらかじめ作成
    $saveId = 200;
    Save::factory([
      'id' => $saveId,
    ]);
    $this->repo->deleteSave($saveId);

    // 指定したIDのレコードがDBに存在しないことを確認
    $this->assertDatabaseMissing('saves', [
      'id' => $saveId,
    ]);
  }
}
