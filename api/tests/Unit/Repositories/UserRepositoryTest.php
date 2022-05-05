<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Models\User;
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
}
