<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\JsonResponse;

interface UserServiceInterface
{
  public function getUsersExceptMyself(): JsonResponse;
  public function getFollowUsers(): JsonResponse;
  public function getFollowUsersId(): JsonResponse;
  // public function getUsersAmountRanking(): JsonResponse;
}
