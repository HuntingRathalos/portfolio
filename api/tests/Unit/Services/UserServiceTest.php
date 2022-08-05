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

        // $this->saveRepositoryMock = Mockery::mock(SaveRepository::class);
        // $this->app->instance(SaveRepositoryInterface::class, $this->saveRepositoryMock);

        // $this->targetRepositoryMock = Mockery::mock(TargetRepository::class);
        // $this->app->instance(TargetRepositoryInterface::class, $this->targetRepositoryMock);

        // $this->tagRepositoryMock = Mockery::mock(TagRepository::class);
        // $this->app->instance(TagRepositoryInterface::class, $this->tagRepositoryMock);
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

    // /**
    //  * UserServiceのgetFollowUsersメソッドの戻り値の型、構造が正しいかを確認する
    //  *
    //  * @return void
    //  */
    // public function testGetFollowUsers()
    // {
    //   // ログインユーザー作成
    //   $user = User::factory()->make();
    //   $this->actingAs($user);

    //   // モックの戻り値作成
    //   $data = new Collection(User::factory()->count(5)->make());

    //   // UserRepositoryのgetFollowUsersをモック
    //   $this->userRepositoryMock->shouldReceive('getFollowUsers')
    //   ->once()
    //   ->andReturn($data);

    //   // TargetRepositoryのgetTargetをモック
    //   $this->targetRepositoryMock->shouldReceive('getTarget')
    //   ->andReturn(Target::factory()->make());

    //   // モックの戻り値作成
    //   $saves = new Collection(Save::factory()->make([
    //     'tag_id' => 3
    //   ]));
    //   \Log::debug($saves);
    //   // SaveRepositoryのgetAllSavesをモック
    //   $this->saveRepositoryMock->shouldReceive('getAllSaves')
    //   ->once()
    //   ->andReturn($saves);

    //   // TagRepositoryのgetTagByIdをモック
    //   $this->tagRepositoryMock->shouldReceive('getTagById')
    //   ->with(3)
    //   ->andReturn(Tag::factory()->make([
    //     'id' => 3,
    //     'name' => '食品'
    //   ]));

    //   // テスト対象のメソッド呼び出し
    //   $userService = $this->app->make(UserService::class);
    //   $response = $userService->getFollowUsers();

    //   // レスポンスがJsonResponseであることを確認
    //   $this->assertInstanceOf(JsonResponse::class, $response);
    //   // JsonResponseインスタンスからjsonデータのみを抽出
    //   $json = $response->content();
    //   // jsonから配列に変換
    //   $arrayResponse = json_decode($json, true);
    //   // レスポンスに含まれる配列の数が5個であることを確認
    //   $this->assertCount(5, $arrayResponse);
    // }

    // /**
    //  * UserServiceのfollowメソッドの戻り値の型を確認する
    //  *
    //  * @return void
    //  */
    // public function testFollow()
    // {
    //   // ログインユーザー作成
    //   $user = User::factory()->make();
    //   $this->actingAs($user);

    //   // ログインユーザーがフォローするユーザー作成
    //   $followUser = User::factory()->make([
    //     'id' => 2
    //   ]);

    //   // UserRepositoryのgetUserByIdをモック
    //   $this->userRepositoryMock->shouldReceive('getUserById')
    //   ->once()
    //   ->with($followUser->id)
    //   ->andReturn($followUser);

    //   // UserRepositoryのfollowをモック
    //   $this->userRepositoryMock->shouldReceive('follow')
    //   ->once()
    //   ->with($followUser)
    //   ->andReturnNull();

    //   // TargetRepositoryのgetTargetをモック
    //   $this->targetRepositoryMock->shouldReceive('getTarget')
    //   ->once()
    //   ->andReturn(Target::factory()->make());

    //   // モックの戻り値作成
    //   $saves = new Collection(Save::factory()->make([
    //     'tag_id' => 3
    //   ]));

    //   // SaveRepositoryのgetAllSavesをモック
    //   $this->saveRepositoryMock->shouldReceive('getAllSaves')
    //   ->once()
    //   ->andReturn($saves);

    //   // TagRepositoryのgetTagByIdをモック
    //   $this->tagRepositoryMock->shouldReceive('getTagById')
    //   ->with(3)
    //   ->andReturn(Tag::factory()->make([
    //     'id' => 3,
    //     'name' => '食品'
    //   ]));

    //   // テスト対象のメソッド呼び出し
    //   $userService = $this->app->make(UserService::class);
    //   $response = $userService->follow($followUser->id);

    //   // レスポンスがJsonResponseであることを確認
    //   $this->assertInstanceOf(JsonResponse::class, $response);

    //   // JsonResponseインスタンスからjsonデータのみを抽出
    //   $json = $response->content();
    //   // jsonから配列に変換
    //   $arrayResponse = json_decode($json, true);
    //   // レスポンスの構造が正しいか確認
    //   $expectedKeys = [
    //     'id',
    //     'name',
    //     'target',
    //     'targetAmount',
    //     'tagName',
    //   ];
    //   $this->assertSame($this->expectedKeys, array_keys($arrayResponse));
    // }

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
