<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\JsonResponse;

interface UserServiceInterface
{
  public function getUsersExceptMyself(): JsonResponse;
  public function getFollowUsers(): JsonResponse;
  public function follow(int $userId): JsonResponse;
  public function unfollow(int $userId): JsonResponse;
}
