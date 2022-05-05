<?php

namespace App\Repositories\Target;

use App\Models\Target;
use Illuminate\Database\Eloquent\Relations\HasOne;

interface TargetRepositoryInterface
{
    public function getTargetById(int $targetId): Target;
    public function getTarget(): ?Target;
    public function createTarget(array $targetDetails): Target;
    public function updateTarget(int $targetId, array $targetDetails): bool;
    public function deleteTarget(int $targetId): void;
}
