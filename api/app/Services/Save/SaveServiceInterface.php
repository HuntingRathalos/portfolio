<?php

namespace App\Services\Save;

use Illuminate\Http\JsonResponse;

interface SaveServiceInterface
{
    public function getAllSaves(): JsonResponse;

    public function getAllSavesAmount(): JsonResponse;

    public function getSavesSpecificPeriod(): JsonResponse;

    public function getSavesByTagId(): JsonResponse;

    public function getSaveRanking(): JsonResponse;

    public function createSave(array $saveDetails): JsonResponse;

    public function updateSave(int $saveId, array $saveDetails): JsonResponse;

    public function deleteSave(int $saveId): JsonResponse;

    public function deleteAllSaves(): JsonResponse;
}
