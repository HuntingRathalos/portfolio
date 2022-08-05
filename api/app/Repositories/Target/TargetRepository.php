<?php

namespace App\Repositories\Target;

use App\Models\Target;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TargetRepository implements TargetRepositoryInterface
{
    private $model;

    /**
     * @param Target $target
     */
    public function __construct(Target $target)
    {
        $this->model = $target;
    }

    /**
     * idから目標レコード1件取得.
     *
     * @param int $targetId
     *
     * @return Target
     */
    public function getTargetById(int $targetId): Target
    {
        return $this->model->findOrFail($targetId);
    }

    /**
     *ユーザーからのリレーションで目標を取得.
     *
     * @return Target
     */
    public function getTarget(): ?Target
    {
        return User::find(Auth::id())->target;
    }

    /**
     * 新しい目標作成.
     *
     * @param array $targetDetails
     *
     * @return Target
     */
    public function createTarget(array $targetDetails): Target
    {
        return $this->model->create([
            'user_id' => Auth::id(),
            'name' => $targetDetails['name'],
            'amount' => $targetDetails['amount'],
        ]);
    }

    /**
     * 目標を更新.
     *
     * @param int   $targetId
     * @param array $targetDetails
     *
     * @return bool
     */
    public function updateTarget(int $targetId, array $targetDetails): bool
    {
        return $this->model->find($targetId)->fill($targetDetails)->save();
    }

    /**
     * 目標を削除.
     *
     * @param int $targetId
     */
    public function deleteTarget(int $targetId): void
    {
        $this->model->destroy($targetId);
    }
}
