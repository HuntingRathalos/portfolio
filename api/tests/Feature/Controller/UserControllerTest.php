<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserControllerTest extends TestCase
{
  use RefreshDatabase;

  private $userRepositoryMock;

  public function setUp(): void
  {
      parent::setUp();

      // 依存しているリポジトリのモック作成
      $this->userRepositoryMock = Mockery::mock(UserRepository::class);
      $this->app->instance(UserRepositoryInterface::class, $this->userRepositoryMock);

      // テストユーザー作成
      $this->user = User::factory()->make();
  }

  public function testGetUsersExceptMyself()
  {
    // モックの戻り値作成
    $users = new Collection(User::factory()->count(5)->make());

    // UserRepositoryのgetUsersExceptMyselfをモック
    $this->userRepositoryMock->shouldReceive('getUsersExceptMyself')
    ->once()
    ->andReturn($users);

    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('GET', '/api/users');

    $response->assertStatus(200);
  }

  // public function testGetFollowUsers()
  // {
  //   // 認証済みユーザーとしてアクセス
  //   $response = $this->actingAs($this->user)
  //     ->json('GET', '/api/users/follow');

  //   $response->assertStatus(200);
  // }

  // public function testFollow()
  // {
  //   $followUser = User::factory()->create([
  //     'id' => 10
  //   ]);
  //   // 認証済みユーザーとしてアクセス
  //   $response = $this->actingAs($this->user)
  //     ->json('PATCH', route('users.follow', ['userId' => $followUser->id]));

  //   $response->assertStatus(201);
  // }

  public function testUnfollow()
  {
    // ログインユーザーがフォローを外すユーザー作成
    $unfollowUser = User::factory()->make([
      'id' => 20
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

    // 認証済みユーザーとしてアクセス
    $response = $this->actingAs($this->user)
      ->json('delete', route('users.unfollow', ['userId' => $unfollowUser->id]));

    $response->assertStatus(204);
  }
}
