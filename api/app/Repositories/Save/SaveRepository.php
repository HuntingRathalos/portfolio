<?php

namespace App\Repositories\Save;

use App\Models\Save;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class SaveRepository implements SaveRepositoryInterface
{
  private $model;

  /**
   * @param Save $save
   */
  public function __construct(Save $save)
  {
      $this->model = $save;
  }

  /**
   * 貯金記録を1件取得
   *
   * @param int $saveId
   * @return Save
   */
  public function getSaveById($saveId): Save
  {
      return $this->model->findOrFail($saveId);
  }

  /**
   * 貯金記録を全件取得
   *
   * @return Collection
   */
  public function getAllSaves(): Collection
  {
       return User::find(Auth::id())->saves;
  }

  /**
   * 1週間分の貯金記録を取得
   *
   * @param string $dateFrom
   * @param string $dateTo
   * @return Collection
   */
  public function getSavesSpecificPeriod(string $dateFrom, string $dateTo): Collection
  {
      return $this->model->where('user_id', Auth::id())
        ->whereBetween('click_date', [$dateFrom, $dateTo])->get();
  }

  /**
   * 新たな貯金記録を作成
   *
   * @param array $saveDetails
   * @return Save
   */
  public function createSave(array $saveDetails): Save
  {
    return $this->model->create([
        'user_id' => Auth::id(),
        'tag_id' => $saveDetails['tag_id'],
        'icon_id' => $saveDetails['icon_id'],
        'memo' => $saveDetails['memo'],
        'coin' => $saveDetails['coin'],
        'click_date' => $saveDetails['click_date'],
        ]);
  }

  /**
   * 貯金記録を更新
   *
   * @param int $saveId
   * @param array $saveDetails
   * @return  bool
   */
  public function updateSave(int $saveId, array $saveDetails): bool
  {
      return $this->model->find($saveId)->fill($saveDetails)->save();
  }

  /**
   * 貯金記録の削除
   *
   * @param int $saveId
   * @return void
   */
  public function deleteSave(int $saveId): void
  {
      $this->model->destroy($saveId);
  }
}
