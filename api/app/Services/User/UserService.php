<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Save\SaveRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
  private $userRepository;
  private $saveRepository;

  /**
   * @param UserRepositoryInterface $userRepository
   * @param SaveRepositoryInterface $saveRepository
   */
  public function __construct(UserRepositoryInterface $userRepository, SaveRepositoryInterface $saveRepository)
  {
    $this->userRepository = $userRepository;
    $this->saveRepository = $saveRepository;
  }

  /**
   * 全ユーザー情報と、最初に貯金したもののタグを取得
   *
   * @return JsonResponse
   */
  public function getAllUsers(): JsonResponse
  {
    $users = $this->model->getUsersExceptMyself();
    $users = $users->load(['saves', 'target', 'saves.tag']);
    $processedUsers = collect();
    $users->each(function ($user) use ($processedUsers) {
      $target = $user->target;
      // $save = $user::where('user_id', $user->id)->first();
      $saves = $user->saves;
      $firstSave = $saves->first();
      $tag = $firstSave->tag;
      if(!$target || !$saves) {
        return
      }
      $processedUsers->push([
        'id' => $user->id,
        'name' => $user->name,
        'target' => $target->name,
        'targetAmount' => $target->amount,
        'tagName' => $tag->name,
        'createdAt' => $user->created_at
      ]);
    });
    return response()->json($processedUsers, Response::HTTP_OK);
  }

  /**
   * ログインユーザーがフォローしている人のidを取得
   *
   * @return JsonResponse
   */
  public function getFollowUsersId(): JsonResponse
  {
    $user = Auth::user();
    $followUsers = $user->followings()；
    if($followUsers) {
      $followUsersId = $followUsers->pluck('followee_id')->toArray();
      return response()->json($followUsersId, Response::HTTP_OK);
    }
    return response()->json(null, Response::HTTP_OK);
  }

  /**
   * ユーザーの合計貯金額ランキングを表示
   *
   * @return JsonResponse
   */
  public function getUsersAmountRanking(): JsonResponse
  {
    $user = Auth::user();
    $user = $user->load(['followers', 'followers.saves']);
    $followers = $user->followers;
    if(!$followers) {
      return response()->json(null, Response::HTTP_OK);
    }
    $processedFollowers = collect();
    foreach($followers as $follower) {
      $saves = $follower->saves;
      if(!$saves->isEmpty()) {
        $coins = $Saves->sum('coin');
        $amount = $coins * 500;
        $processedFollowers->push([
          'name' => $follower->name,
          'saveAmount' => $amount
        ]);
      }
    }
    return response()->json($processedFollowers, Response::HTTP_OK);
  }
}
