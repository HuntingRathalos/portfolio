<?php

namespace App\Services\Target;

use App\Models\Target;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

interface TargetServiceInterface
{
  // public function getTargetById(): JsonResponse;
  public function createTarget(array $targetDetails): JsonResponse;
  public function updateTarget(int $targetId, array $targetDetails): JsonResponse;
  public function deleteTarget(int $targetId): JsonResponse;
}
