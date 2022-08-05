<?php

namespace App\Services\Target;

use Illuminate\Http\JsonResponse;

interface TargetServiceInterface
{
    // public function getTargetById(): JsonResponse;
    public function getTarget(): JsonResponse;

    public function createTarget(array $targetDetails): JsonResponse;

    public function updateTarget(int $targetId, array $targetDetails): JsonResponse;

    public function deleteTarget(int $targetId): JsonResponse;
}
