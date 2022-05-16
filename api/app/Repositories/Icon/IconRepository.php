<?php

namespace App\Repositories\Icon;

use App\Models\Icon;

class IconRepository implements IconRepositoryInterface
{
  private $model;

  /**
   * @param Icon $icon
   */
  public function __construct(Icon $icon)
  {
      $this->model = $icon;
  }
  /**
   * idからiconモデルを取得
   *
   * @param integer $iconId
   * @return Icon
   */
  public function getIconById(int $iconId): Icon
  {
    return $this->model->findOrFail($iconId);
  }
}
