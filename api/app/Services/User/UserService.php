<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class UserService implements UserServiceInterface
{
  private $userRepository;

  /**
   * @param UserRepositoryInterface $userRepository
   */
  public function __construct(UserRepositoryInterface $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  /**
   * 自分以外の全ユーザー情報と、最初に貯金したもののタグを取得
   *
   * @return JsonResponse
   */
  public function getUsersExceptMyself(): JsonResponse
  {
    $users = $this->model->getUsersExceptMyself();
    $users = $users->load(['saves', 'target', 'saves.tag']);
    Log::debug($users);
    $processedUsers = collect();
    $users->each(function ($user) use ($processedUsers) {
      $target = $user->target;
      // $save = $user::where('user_id', $user->id)->first();
      $saves = $user->saves;
      $tag = $firstSave->tag;
      if(!$target || !$saves) {
        return;
      }
      $firstSave = $saves->first();
      Log::debug($firstSave);
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
   * ログインユーザーがフォローしている人の情報と、最初に貯金したもののタグを取得
   *
   * @return JsonResponse
   */
  public function getFollowUsers(): JsonResponse
  {
    $user = Auth::user();
    $followUsers = $user->followings;
    if($followUsers) {
      return response()->json(null, Response::HTTP_OK);
    }
    $followUsers = $followUsers->load(['saves', 'target', 'saves.tag']);
    Log::debug($followUsers);
    $processedUsers = collect();
    $users->each(function ($user) use ($processedUsers) {
      $target = $user->target;
      // $save = $user::where('user_id', $user->id)->first();
      $saves = $user->saves;
      $tag = $firstSave->tag;
      if(!$target || !$saves) {
        return;
      }
      $firstSave = $saves->first();
      Log::debug($firstSave);
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
    $followUsers = $user->followings;
    if($followUsers) {
      $followUsersId = $followUsers->pluck('followee_id')->toArray();
      Log::debug($followUsersIdArray);
      return response()->json($followUsersIdArray, Response::HTTP_OK);
    }
    return response()->json(null, Response::HTTP_OK);
  }

  // /**
  //  * ユーザーの合計貯金額ランキングを表示
  //  *
  //  * @return JsonResponse
  //  */
  // public function getUsersAmountRanking(): JsonResponse
  // {
  //   $user = Auth::user();
  //   $user = $user->load(['followers', 'followers.saves']);
  //   $followers = $user->followers;
  //   if(!$followers) {
  //     return response()->json(null, Response::HTTP_OK);
  //   }
  //   $processedFollowers = collect();
  //   foreach($followers as $follower) {
  //     $saves = $follower->saves;
  //     if(!$saves->isEmpty()) {
  //       $coins = $Saves->sum('coin');
  //       $amount = $coins * 500;
  //       $processedFollowers->push([
  //         'name' => $follower->name,
  //         'saveAmount' => $amount
  //       ]);
  //     }
  //   }
  //   return response()->json($processedFollowers, Response::HTTP_OK);
  // }
}
