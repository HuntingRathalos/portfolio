<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
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
   * ログインユーザーがフォローしているユーザーを取得
   *
   * @return Collection
   */
  public function getFollowUsers(): Collection
  {
    return Auth::user()->followings;
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
   * @param int $userId
   * @return User
   */
  public function getUserById(int $userId): User
  {
    return $this->model->findOrFail($userId);
  }

  /**
   * ユーザーがフォローしたときに、中間テーブルにレコード作成
   *
   * @param User $followUser
   * @return void
   */
  public function follow(User $followUser): void
  {
    Auth::user()->followings()->detach($followUser);
    Auth::user()->followings()->attach($followUser);
  }

  /**
   * ユーザーがフォローを外したときに、中間テーブルのレコード削除
   *
   * @param User $followUser
   * @return void
   */
  public function unfollow(User $followUser): void
  {
    Auth::user()->followings()->detach($followUser);
  }
 }
