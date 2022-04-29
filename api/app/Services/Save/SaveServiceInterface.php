<?php

namespace App\Services\Save;

use App\Models\Save;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

interface SaveServiceInterface
{
    public function getSavesSpecificPeriod(): JsonResponse;
    public function getAllSaves(): JsonResponse;
    public function createSave(array $saveDetails): JsonResponse;
    public function updateSave(int $saveId, array $saveDetails): JsonResponse;
    public function deleteSave(int $saveId): JsonResponse;
}
