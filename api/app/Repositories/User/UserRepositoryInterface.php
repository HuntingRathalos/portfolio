<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
  public function getAllUsers() : Collection;
  public function getFollowUsers(): Collection;
  public function getUsersExceptMyself(): Collection;
  public function getUserById(int $userId) : User;
  public function follow(User $followUser): void;
  public function unfollow(User $followUser): void;
}
