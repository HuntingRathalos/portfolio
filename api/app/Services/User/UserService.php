<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\FollowedNotification;
use Database\Factories\FollowFactory;
use Illuminate\Support\Facades\Log;

class UserService implements UserServiceInterface
{
  // ゲストユーザー用のIDを定数として保持
  private const GUEST_USER_ID = 2;

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
    // ゲストユーザー作成するので、空判定せずに、ユーザーのid、名前、作成日に加工して返却する
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
    $followUsers = $this->userRepository->getFollowUsers();

    $processedUsers = collect();

    if($followUsers->isEmpty()) {
      return response()->json($followUsers, Response::HTTP_OK);
    }


    $followUsers->each(function ($followUser) use ($processedUsers) {
      $target = $followUser->target;
      $saves = $followUser->saves;

      // フォローしたユーザーの貯金記録、または目標設定がない時は'設定されていません'を詰める
      if(!$target || $saves->isEmpty()) {
        $processedUser = $this->processUser($followUser->id, $followUser->name, null, null, null);
        $processedUsers->push($processedUser);
      } else {
        $firstSave = $saves->shift();
        $tag = $firstSave->tag;

        $processedUser = $this->processUser($followUser->id, $followUser->name, $target->name, $target->amount, $tag->name);
        $processedUsers->push($processedUser);
      }
    });
    return response()->json($processedUsers, Response::HTTP_OK);
  }

  /**
   * ユーザーがフォローしたときに、中間テーブルにレコード作成
   *
   * @param integer $userId
   * @return JsonResponse
   */
  public function follow(int $userId): JsonResponse
  {
    // ログインユーザー
    $user = Auth::user();
    // ログインユーザーがフォローしたユーザー
    $followUser = $this->userRepository->getUserById($userId);

    // ログインユーザーがあるユーザーを重ねてフォローできないようにするため削除後に登録
    $this->userRepository->follow($followUser);

    // フォローされたことを通知
    $followUser->notify(new FollowedNotification(Auth::user()));

    $target = $followUser->target;
    $saves = $followUser->saves;

    $processedFollowUser = [];
    // フォローしたユーザーの貯金記録、または目標設定がない時は'設定されていません'を詰める
    if(!$target || $saves->isEmpty()) {
      $processedFollowUser = $this->processUser($followUser->id, $followUser->name, null, null, null);

    } else {
      $firstSave = $saves->shift();
      $tag = $firstSave->tag;

      $processedFollowUser = $this->processUser($followUser->id, $followUser->name, $target->name, $target->amount, $tag->name);
    }
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
    // ログインユーザー
    $user = Auth::user();
    // ログインユーザーがフォローを外したユーザー
    $unfollowUser = $this->userRepository->getUserById($userId);
    $this->userRepository->unfollow($unfollowUser);

    return response()->json(null, Response::HTTP_NO_CONTENT);
  }

  protected function processUser(int $id, string $name, ?string $target, ?int $amount, ?string $tag) {
    return [
      'id' => $id,
      'name' => $name,
      'target' => $target ?? '設定されていません。',
      'targetAmount' => $amount ?? '設定されていません。',
      'tagName' => $tag ?? '設定されていません。'
    ];
  }
}
