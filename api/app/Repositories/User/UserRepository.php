<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;


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

  /**
   * 自分以外のユーザー情報取得
   *
   * @return Collection
   */
  public function getUsersExceptMyself(): Collection
  {
    return $this->model::where('id', '!=', Auth::id())->get();
  }
  /**
   * ユーザー情報を取得
   *
   * @return User
   */
  public function getUserById(): User
  {
    return $this->model->findOrFail(Auth::id());
  }
 }
