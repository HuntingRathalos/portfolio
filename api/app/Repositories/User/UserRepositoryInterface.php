<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
  public function getAllUsers() : Collection;
  public function getUsersExceptMyself(): Collection;
  public function getUserById(int $userId) : User;
}
