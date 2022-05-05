<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
 {
  private $model;

  /**
   * @param User $user
   */
  public function __construct(User $user)
  {
      $this->model = $user;
  }

  /**
   * 全ユーザー情報を取得
   *
   * @return Collection
   */
  public function getAllUsers(): Collection
  {
    return $this->model->get();
  }
 }
