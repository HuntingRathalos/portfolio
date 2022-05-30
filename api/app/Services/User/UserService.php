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
use Illuminate\Support\Facades\Log;


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

    // フォローしているユーザーがいない時は、ゲストユーザーをフォローする
    if($followUsers->isEmpty()) {
      // ゲストユーザー
      $followUser = $this->userRepository->getUserById(self::GUEST_USER_ID);
      // ログインユーザーがあるユーザーを重ねてフォローできないようにするため削除後に登録
      $this->userRepository->follow($followUser);

      $processedUsers->push([
        'id' => self::GUEST_USER_ID,
        'name' => '山田太郎',
        'target' => 'ワンピース全巻購入!!',
        'targetAmount' => 50000,
        'tagName' => '外食'
      ]);
      return response()->json($processedUsers, Response::HTTP_OK);
    }

    $followUsers = $followUsers->load(['saves', 'target', 'saves.tag']);

    $followUsers->each(function ($followUser) use ($processedUsers) {
      $target = $this->targetRepository->getTarget();
      $saves = $this->saveRepository->getAllSaves();

      // フォローしたユーザーの貯金記録、または目標設定がない時は'設定されていません'を詰める
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
        $tag = $this->tagRepository->getTagById($firstSave->tag_id);
        $processedUsers->push([
          'id' => $followUser->id,
          'name' => $followUser->name,
          'target' => $target->name,
          'targetAmount' => $target->amount."円",
          'tagName' => $tag->name,
        ]);
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

    $target = $this->targetRepository->getTarget();
    $saves = $this->saveRepository->getAllSaves();

    $processedFollowUser = [];
    // フォローしたユーザーの貯金記録、または目標設定がない時は'設定されていません'を詰める
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
      $tag = $this->tagRepository->getTagById($firstSave->tag_id);
      $processedFollowUser = (object)[
        'id' => $followUser->id,
        'name' => $followUser->name,
        'target' => $target->name,
        'targetAmount' => $target->amount,
        'tagName' => $tag->name,
      ];
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
}
