<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Save\SaveRepositoryInterface;
use App\Repositories\Target\TargetRepositoryInterface;
use App\Repositories\Tag\TagRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\FollowedNotification;
use Database\Factories\FollowFactory;

class UserService implements UserServiceInterface
{
  // ゲストユーザー用のIDを定数として保持
  private const GUEST_USER_ID = 2;

  private $userRepository;
  private $saveRepository;
  private $targetRepository;
  private $tagRepository;

  /**
   * @param UserRepositoryInterface $userRepository
   * @param SaveRepositoryInterface $saveRepository
   * @param TargetRepositoryInterface $targetRepository
   * @param TagRepositoryInterface $tagRepository
   */
  public function __construct(
    UserRepositoryInterface $userRepository,
    SaveRepositoryInterface $saveRepository,
    TargetRepositoryInterface $targetRepository,
    TagRepositoryInterface $tagRepository,
    )
  {
    $this->userRepository = $userRepository;
    $this->saveRepository = $saveRepository;
    $this->targetRepository = $targetRepository;
    $this->tagRepository = $tagRepository;
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
    $user = Auth::user();
    $followUsers = $this->userRepository->getFollowUsers();
    $processedUsers = collect();

    if($followUsers->isEmpty()) {
      return response()->json($followUsers, Response::HTTP_OK);
    }

    $followUsers = $followUsers->load(['saves', 'target', 'saves.tag']);

    $followUsers->each(function ($followUser) use ($processedUsers) {
      $target = $this->targetRepository->getTarget();
      $saves = $this->saveRepository->getAllSaves();

      // フォローしたユーザーの貯金記録、または目標設定がない時は'設定されていません'を詰める
      if(!$target || $saves->isEmpty()) {
        $processedUser = $this->processUser($followUser->id, $followUser->name, null, null, null);
        $processedUsers->push($processedUser);
      } else {
        $firstSave = $saves->shift();
        $tag = $this->tagRepository->getTagById($firstSave->tag_id);
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

    $target = $this->targetRepository->getTarget();
    $saves = $this->saveRepository->getAllSaves();

    $processedFollowUser = [];
    // フォローしたユーザーの貯金記録、または目標設定がない時は'設定されていません'を詰める
    if(!$target || $saves->isEmpty()) {
      $processedFollowUser = $this->processUser($followUser->id, $followUser->name, null, null, null);

    } else {
      $firstSave = $saves->shift();
      $tag = $this->tagRepository->getTagById($firstSave->tag_id);
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
