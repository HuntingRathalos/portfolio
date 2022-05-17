<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Models\User;
use App\Models\Follow;
use App\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UserRepositoryTest extends TestCase
{
  use RefreshDatabase;

  public function setUp(): void
  {
      parent::setUp();

      //  依存解決しながらリポジトリ取得
      $this->repo = $this->app->make(UserRepository::class);
  }

  public function testGetAllUsers()
   {
    User::factory()->count(3)->create();

    $users = $this->repo->getAllUsers();
    // DBに保存されていることを確認
    $this->assertDatabaseCount('users', 3);
    $this->assertInstanceOf(Collection::class, $users);
   }

   public function testGetFollowUsers()
   {
    // ログインユーザー作成
    $user = User::factory()->create();
    $this->actingAs($user);

    // フォローするユーザーレコードを作成(FollowFactoryの定義に合うように計20個レコード作成)
    User::factory()->count(19)->create();

    // あらかじめ中間テーブルにレコードを作成
    Follow::factory()->count(5)->create([
      'follower_id' => $user->id
    ]);

    $followUsers = $this->repo->getFollowUsers();

    // 取得したレコードの数が正しいことを確認
    $recordNum = $followUsers->count();
    $this->assertSame(5, $recordNum);
    // 返り値がcollectionであることを確認
    $this->assertInstanceOf(Collection::class, $followUsers);
   }

   public function testGetUsersExceptMyself()
   {
    // ログインユーザー作成
    $user = User::factory()->create();
    $this->actingAs($user);

    // ログインユーザー以外のレコードを作成
    User::factory()->count(10)->create();

    $users = $this->repo->getUsersExceptMyself();

    // 取得したレコードの数が正しいことを確認
    $recordNum = $users->count();
    $this->assertSame(10, $recordNum);
    // 返り値がcollectionであることを確認
    $this->assertInstanceOf(Collection::class, $users);
   }

   public function testGetUserById()
   {
    // ユーザー作成
    $user = User::factory()->create();

    $gotUser = $this->repo->getUserById($user->id);

    // 返り値がUserインスタンスであることを確認
    $this->assertInstanceOf(User::class, $gotUser);
   }

   public function testFollow()
   {
     // ログインユーザー作成
    $user = User::factory()->create();
    $this->actingAs($user);

    // ログインユーザーがフォローするユーザーを作成
    $followUser = User::factory()->create();

    $this->repo->follow($followUser);

    // DBに保存されていることを確認
    $this->assertDatabaseHas('follows', [
      'follower_id' => $user->id,
      'followee_id' => $followUser->id
    ]);
   }

   public function testUnfollow()
   {
    // ログインユーザー作成
    $user = User::factory()->create();
    $this->actingAs($user);

    // ログインユーザーがフォローを外すユーザー作成
    $unfollowUser = User::factory()->create();

    // あらかじめ中間テーブルにレコードを作成
    Follow::factory()->create([
      'follower_id' => $user->id,
      'followee_id' => $unfollowUser->id,
    ]);

    $this->repo->unfollow($unfollowUser);

    // 指定したレコードがDBに存在しないことを確認
    $this->assertDatabaseMissing('follows', [
      'follower_id' => $user->id,
      'followee_id' => $unfollowUser->id,
    ]);
   }
}
