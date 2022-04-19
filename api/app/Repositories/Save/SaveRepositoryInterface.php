<?php

namespace App\Repositories\Save;

use App\Models\Save;
use Illuminate\Database\Eloquent\Collection;

interface SaveRepositoryInterface
{
    public function getSavesOneMonth(string $dateFrom, string $dateTo): Collection;
    public function createSave(array $saveDetails): Save;
    public function updateSave(int $saveId, array $saveDetails): bool;
    public function deleteSave(int $saveId): void;
}
