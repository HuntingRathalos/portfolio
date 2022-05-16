<?php

namespace App\Repositories\Icon;

use App\Models\Icon;

interface IconRepositoryInterface
{
  public function getIconById(int $iconId): Icon;
}
