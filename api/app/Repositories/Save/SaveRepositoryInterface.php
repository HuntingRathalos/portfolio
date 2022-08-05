<?php

namespace App\Repositories\Save;

use App\Models\Save;
use Illuminate\Database\Eloquent\Collection;

interface SaveRepositoryInterface
{
    public function getSaveById($saveId): Save;

    public function getAllSaves(): Collection;

    public function getSavesSpecificPeriod(string $dateFrom, string $dateTo): Collection;

    public function createSave(array $saveDetails): Save;

    public function updateSave(int $saveId, array $saveDetails): bool;

    public function deleteSave(int $saveId): void;
}
