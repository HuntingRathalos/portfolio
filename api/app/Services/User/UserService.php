<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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
    $users = $this->userRepository->getUsersExceptMyself();
    $processedUsers = collect();
    $users->each(function ($user) use ($processedUsers) {
        $processedUsers->push([
          'id' => $user->id,
          'name' => $user->name,
          'createdAt' => (new Carbon($user->created_at))->toDateString()
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
    $processedUsers = collect();
    if($followUsers->isEmpty()) {
      $processedUsers->push([
        'id' => 400,
        'name' => 'plpl',
        'target' => '設定されていません。',
        'targetAmount' => '設定されていません。',
        'tagName' => '設定されていません。'
      ]);
      return response()->json($processedUsers, Response::HTTP_OK);
    }
    $followUsers = $followUsers->load(['saves', 'target', 'saves.tag']);
    Log::debug($followUsers);
    $followUsers->each(function ($followUser) use ($processedUsers) {
      $target = $followUser->target;
      $saves = $followUser->saves;
      if(!$target || $saves->isEmpty()) {
        $processedUsers->push([
          'id' => $followUser->id,
          'name' => $followUser->name,
          'target' => '設定されていません。',
          'targetAmount' => '設定されていません。',
          'tagName' => '設定されていません。'
        ]);
      } else {
        $firstSave = $saves->shift();
        $tag = $firstSave->tag;
        $processedUsers->push([
          'id' => $followUser->id,
          'name' => $followUser->name,
          'target' => $target->name,
          'targetAmount' => $target->amount,
          'tagName' => $tag->name,
        ]);
      }
      Log::debug($processedUsers);
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

  /**
   * ユーザーがフォローしたときに、中間テーブルにレコード作成
   *
   * @param integer $userId
   * @return JsonResponse
   */
  public function follow(int $userId): JsonResponse
  {
    $user = Auth::user();
    $followUser = $this->userRepository->getUserById($userId);
    $user->followings()->detach($followUser);
    $user->followings()->attach($followUser);

    $target = $followUser->target;
    $saves = $followUser->saves;

    Log::debug($target);
    Log::debug($saves);
    $processedFollowUser = [];
    if(!$target || $saves->isEmpty()) {
      $processedFollowUser = (object)[
        'id' => $followUser->id,
        'name' => $followUser->name,
        'target' => '設定されていません。',
        'targetAmount' => '設定されていません。',
        'tagName' => '設定されていません。'
      ];
    } else {
      $firstSave = $saves->shift();
      $tag = $firstSave->tag;
      $processedFollowUser = (object)[
        'id' => $followUser->id,
        'name' => $followUser->name,
        'target' => $target->name,
        'targetAmount' => $target->amount,
        'tagName' => $tag->name,
      ];
    }
    Log::debug(print_r($processedFollowUser, true));
    return response()->json($processedFollowUser, Response::HTTP_CREATED);
  }

  /**
   * ユーザーがフォローを外したときに、中間テーブルのレコード削除
   *
   * @param integer $userId
   * @return JsonResponse
   */
  public function unfollow(int $userId): JsonResponse
  {
    $user = Auth::user();
    $followUser = $this->userRepository->getUserById($userId);
    $user->followings()->detach($followUser);

    return response()->json(null, Response::HTTP_NO_CONTENT);
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
