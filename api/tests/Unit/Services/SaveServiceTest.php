<?php

namespace Tests\Unit\Services;

use App\Models\Save;
use App\Repositories\Save\SaveRepository;
use App\Repositories\Save\SaveRepositoryInterface;
use App\Services\Save\SaveService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Mockery;
use Tests\TestCase;

class SaveServiceTest extends TestCase
{
    use RefreshDatabase;

    private $saveRepositoryMock;
    private $tagRepositoryMock;

    public function setUp(): void
    {
        parent::setUp();

        // 依存しているリポジトリのモック作成
        $this->saveRepositoryMock = Mockery::mock(SaveRepository::class);
        $this->app->instance(SaveRepositoryInterface::class, $this->saveRepositoryMock);

        // レスポンスの構造を確認するための配列
        $this->saveModelKeys = [
            'user_id',
            'tag_id',
            'icon_id',
            'coin',
            'memo',
            'click_date',
        ];
    }

    /**
     * SaveServiceのgetAllSavesメソッドの戻り値の型、構造が正しいかを確認する.
     */
    public function testGetAllSaves()
    {
        // モックの戻り値作成
        $data = new Collection(Save::factory()->count(5)->make());

        // SaveRepositoryのgetAllSavesをモック
        $this->saveRepositoryMock->shouldReceive('getAllSaves')
            ->once()
            ->andReturn($data);

        // テスト対象のメソッド呼び出し
        $saveService = $this->app->make(SaveService::class);
        $response = $saveService->getAllSaves();

        // JsonResponseインスタンスからjsonデータのみを抽出
        $json = $response->content();
        // jsonから配列に変換
        $arrayResponse = json_decode($json, true);
        // レスポンスに含まれる配列の数が7個であることを確認
        $this->assertCount(5, $arrayResponse);
        // レスポンスがJsonResponseであることを確認
        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    /**
     * SaveServiceのgetAllSavesAmountメソッドの戻り値の型、構造が正しいかを確認する.
     */
    public function testGetAllSavesAmount()
    {
        // モックの戻り値作成
        $data = new Collection(
            Save::factory()->count(3)->make([
                'coin' => 3,
            ])
        );

        // SaveRepositoryのgetAllSavesをモック
        $this->saveRepositoryMock->shouldReceive('getAllSaves')
            ->once()
            ->andReturn($data);

        // テスト対象のメソッド呼び出し
        $saveService = $this->app->make(SaveService::class);
        $response = $saveService->getAllSavesAmount();

        // レスポンスがJsonResponseであることを確認
        $this->assertInstanceOf(JsonResponse::class, $response);
        // JsonResponseインスタンスからjsonデータのみを抽出
        $json = $response->content();
        // 返り値が合計貯金額になることを確認
        $this->assertSame($json, '4500');
    }

    /**
     * SaveServiceのgetSavesSpecificPeriodメソッドの戻り値の型、構造が正しいかを確認する.
     */
    public function testgetSavesSpecificPeriod()
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
                'click_date' => $dateFromThisWeek,
            ])
        );

        // SaveRepositoryのgetSavesSpecificPeriodをモック
        $this->saveRepositoryMock->shouldReceive('getSavesSpecificPeriod')
            ->once()
            ->with($dateFromThisWeek, $dateToThisWeek)
            ->andReturn($data);

        // テスト対象のメソッド呼び出し
        $saveService = $this->app->make(SaveService::class);
        $response = $saveService->getSavesSpecificPeriod();

        // レスポンスがJsonResponseであることを確認
        $this->assertInstanceOf(JsonResponse::class, $response);
        // JsonResponseインスタンスからjsonデータのみを抽出
        $json = $response->content();
        // jsonから配列に変換
        $arrayResponse = json_decode($json, true);
        // レスポンスに含まれる配列の数が7個であることを確認
        $this->assertCount(7, $arrayResponse);
    }

    /**
     * SaveServiceのcreateSaveメソッドの戻り値の型、構造が正しいかを確認する.
     */
    public function testCreateSave()
    {
        // モックの引数作成
        $saveDetails = [
            'user_id' => 1,
            'tag_id' => 1,
            'icon_id' => 2,
            'coin' => 3,
            'memo' => '一日一枚',
            'click_date' => '2022-4-22',
        ];
        // SaveRepositoryのcreateSaveをモック
        $this->saveRepositoryMock->shouldReceive('createSave')
            ->once()
            ->with(Mockery::on(function ($saveDetailsArray) use ($saveDetails) {
                $this->assertSame($saveDetailsArray, $saveDetails)
                && is_array($saveDetailsArray);

                return true;
            }))
            ->andReturn(Save::factory()->make());

        // テスト対象のメソッド呼び出し
        $saveService = $this->app->make(SaveService::class);
        $response = $saveService->createSave($saveDetails);
        // レスポンスがJsonResponseであることを確認
        $this->assertInstanceOf(JsonResponse::class, $response);

        // 正しい構造のレスポンスが返っていることを確認
        $this->convertJsonResponseIntoArray($response);
    }

    /**
     * SaveServiceのupdateSaveメソッドの戻り値の型、構造が正しいかを確認する.
     */
    public function testUpdateSave()
    {
        // モックの引数作成
        $saveId = 1;
        $saveDetails = [
            'memo' => '２枚貯金した',
        ];

        // SaveRepositoryのupdateSaveをモック
        $this->saveRepositoryMock->shouldReceive('updateSave')
            ->once()
            ->with($saveId, Mockery::on(function ($saveDetailsArray) use ($saveDetails) {
                $this->assertSame($saveDetailsArray, $saveDetails)
                && is_array($saveDetailsArray);

                return true;
            }))
            ->andReturn(true);

        // SaveRepositoryのgetSaveByIdをモック
        $this->saveRepositoryMock->shouldReceive('getSaveById')
            ->once()
            ->with($saveId)
            ->andReturn(Save::factory()->make());

        // テスト対象のメソッド呼び出し
        $saveService = $this->app->make(SaveService::class);
        $response = $saveService->updateSave($saveId, $saveDetails);
        // レスポンスがJsonResponseであることを確認
        $this->assertInstanceOf(JsonResponse::class, $response);

        // 正しい構造のレスポンスが返っていることを確認
        $this->convertJsonResponseIntoArray($response);
    }

    public function testDeleteSave()
    {
        // モックの引数作成
        $saveId = 2;

        // SaveRepositoryのdeleteSaveをモック
        $this->saveRepositoryMock->shouldReceive('deleteSave')
            ->once()
            ->with($saveId)
            ->andReturnNull();

        // テスト対象のメソッド呼び出し
        $saveService = $this->app->make(SaveService::class);
        $response = $saveService->deleteSave($saveId);

        // レスポンスがJsonResponseであることを確認
        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    /**
     * JsonResponseインスタンスを受け取り、配列に変換後、構造を確認する.
     *
     * @param $response
     */
    public function convertJsonResponseIntoArray($response): void
    {
        // JsonResponseインスタンスからjsonデータのみを抽出
        $json = $response->content();
        // jsonから配列に変換
        $arrayResponse = json_decode($json, true);
        // レスポンスの構造が正しいか確認
        $this->assertSame($this->saveModelKeys, array_keys($arrayResponse));
    }
}
