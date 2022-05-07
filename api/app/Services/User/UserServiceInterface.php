<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\JsonResponse;

interface UserServiceInterface
{
  public function getAllUsers(): JsonResponse;
  public function getFollowUsersId(): JsonResponse;
  public function getUsersAmountRanking(): JsonResponse;
}
