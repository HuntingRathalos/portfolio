<?php

namespace Tests\Unit\Services;

use App\Models\Save;
use App\Models\Tag;
use App\Models\Target;
use App\Models\User;
use App\Repositories\Save\SaveRepository;
use App\Repositories\Save\SaveRepositoryInterface;
use App\Repositories\Tag\TagRepository;
use App\Repositories\Tag\TagRepositoryInterface;
use App\Repositories\Target\TargetRepository;
use App\Repositories\Target\TargetRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Mockery;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    private $userRepositoryMock;
    private $saveRepositoryMock;
    private $targetRepositoryMock;
    private $tagRepositoryMock;

    public function setUp(): void
    {
        parent::setUp();

        // 依存しているリポジトリのモック作成
        $this->userRepositoryMock = Mockery::mock(UserRepository::class);
        $this->app->instance(UserRepositoryInterface::class, $this->userRepositoryMock);
    }

    /**
     * UserServiceのgetUsersExceptMyselfメソッドの戻り値の型、構造が正しいかを確認する.
     */
    public function testGetUsersExceptMyself()
    {
        // ログインユーザー作成
        $user = User::factory()->make();
        $this->actingAs($user);

        // モックの戻り値作成
        $data = new Collection(User::factory()->count(5)->make());

        // UserRepositoryのgetUsersExceptMyselfをモック
        $this->userRepositoryMock->shouldReceive('getUsersExceptMyself')
            ->once()
            ->andReturn($data);

        // テスト対象のメソッド呼び出し
        $userService = $this->app->make(UserService::class);
        $response = $userService->getUsersExceptMyself();

        // レスポンスがJsonResponseであることを確認
        $this->assertInstanceOf(JsonResponse::class, $response);
        // JsonResponseインスタンスからjsonデータのみを抽出
        $json = $response->content();
        // jsonから配列に変換
        $arrayResponse = json_decode($json, true);
        // レスポンスに含まれる配列の数が5個であることを確認
        $this->assertCount(5, $arrayResponse);
    }

    /**
     * UserServiceのunfollowメソッドの戻り値の型を確認する.
     */
    public function testUnfolllow()
    {
        // ログインユーザー作成
        $user = User::factory()->make();
        $this->actingAs($user);

        // ログインユーザーがフォローを外すユーザー作成
        $unfollowUser = User::factory()->make([
            'id' => 3,
        ]);

        // UserRepositoryのgetUserByIdをモック
        $this->userRepositoryMock->shouldReceive('getUserById')
            ->once()
            ->with($unfollowUser->id)
            ->andReturn($unfollowUser);

        // UserRepositoryのunfollowをモック
        $this->userRepositoryMock->shouldReceive('unfollow')
            ->once()
            ->with($unfollowUser)
            ->andReturnNull();

        // テスト対象のメソッド呼び出し
        $userService = $this->app->make(UserService::class);
        $response = $userService->unfollow($unfollowUser->id);

        // レスポンスがJsonResponseであることを確認
        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}
