<?php

namespace Tests\Unit\Services;

use App\Models\Target;
use Tests\TestCase;
use Mockery;
use App\Repositories\Target\TargetRepositoryInterface;
use App\Repositories\Target\TargetRepository;
use App\Services\Target\TargetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TargetServiceTest extends TestCase
{
    use RefreshDatabase;

    private $targetRepositoryMock;

    public function setUp(): void
    {
      parent::setUp();

      // 依存しているリポジトリのモック作成
      $this->targetRepositoryMock = Mockery::mock(TargetRepository::class);
      $this->app->instance(TargetRepositoryInterface::class, $this->targetRepositoryMock);

      // レスポンスの構造を確認するための配列
      $this->targetModelKeys = [
        'user_id',
        'name',
        'amount',
      ];
    }

    /**
     * TargetServiceのcreateTargetメソッドの戻り値の型、構造が正しいかを確認する
     *
     * @return void
     */
    public function testCreateTarget()
    {
        // モックの引数作成
        $targetDetails = [
          'user_id' => 1,
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
          ->andReturn(Target::factory()->make());

        // テスト対象のメソッド呼び出し
        $targetService = $this->app->make(TargetService::class);
        $response = $targetService->createTarget($targetDetails);
        // レスポンスがJsonResponseであることを確認
        $this->assertInstanceOf(JsonResponse::class, $response);

        // 正しい構造のレスポンスが返っていることを確認
        $this->convertJsonResponseIntoArray($response);
    }

    /**
     * TargetServiceのupdateTargetメソッドの戻り値の型、構造が正しいかを確認する
     *
     * @return void
     */
    public function testUpdateTarget()
    {
        // モックの引数作成
        $targetId = 1;
        $targetDetails = [
          'name' => 'ゲームを買う',
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
          ->andReturn(Target::factory()->make());

        // テスト対象のメソッド呼び出し
        $targetService = $this->app->make(TargetService::class);
        $response = $targetService->updateTarget($targetId, $targetDetails);
        // レスポンスがJsonResponseであることを確認
        $this->assertInstanceOf(JsonResponse::class, $response);

        // 正しい構造のレスポンスが返っていることを確認
        $this->convertJsonResponseIntoArray($response);
    }

    /**
     * TargetServiceのdeleteTargetメソッドの戻り値の型、構造が正しいかを確認する
     *
     * @return void
     */
    public function testDeleteTarget()
    {
        // モックの引数作成
        $targetId = 2;

        // TargetRepositoryのdeleteTargetをモック
        $this->targetRepositoryMock->shouldReceive('deleteTarget')
          ->once()
          ->with($targetId)
          ->andReturnNull();

        // テスト対象のメソッド呼び出し
        $targetService = $this->app->make(TargetService::class);
        $response = $targetService->deleteTarget($targetId);

        // レスポンスがJsonResponseであることを確認
        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    /**
     * JsonResponseインスタンスを受け取り、配列に変換後、構造を確認する
     *
     * @param $response
     * @return void
     */
    public function convertJsonResponseIntoArray($response): void
    {
        // JsonResponseインスタンスからjsonデータのみを抽出
        $json = $response->content();
        // jsonから配列に変換
        $arrayResponse = json_decode($json, true);
        // レスポンスの構造が正しいか確認
        $this->assertSame($this->targetModelKeys, array_keys($arrayResponse));
    }

}
