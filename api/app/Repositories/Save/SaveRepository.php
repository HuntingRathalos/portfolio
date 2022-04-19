<?php

namespace App\Repositories\Save;

use App\Models\Save;
use Illuminate\Database\Eloquent\Collection;

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
   * カレンダーを表示している1ヶ月分の貯金記録を取得
   *
   * @param string $dateFrom
   * @param string $dateTo
   * @return Collection
   */
  public function getSavesOneMonth(string $dateFrom, string $dateTo): Collection
  {
      return $this->model->whereBetween('click_date', [$dateFrom, $dateTo])->get();
  }

  /**
   * 新たな貯金記録を作成
   *
   * @param array $saveDetails
   * @return Save
   */
  public function createSave(array $saveDetails): Save
  {
      return $this->model->create($saveDetails);
  }

  /**
   * 貯金記録を更新
   *
   * @param int $saveId
   * @param array $saveDetails
   * @return Save
   */
  public function updateSave(int $saveId, array $saveDetails): Save
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
