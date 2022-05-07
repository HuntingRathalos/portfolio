<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userRepository;
    private $userService;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param UserServiceInterface $userService
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserServiceInterface $userService
        )
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    /**
     * 自分以外の全ユーザー情報と、最初に貯金したもののタグを取得
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsersExceptMyself()
    {
        return $this->userService->getUsersExceptMyself();
    }

    /**
     * ログインユーザーがフォローしている人の情報と、最初に貯金したもののタグを取得
     *
     * @return void
     */
    public function getFollowUsers()
    {
        return $this->userService->getFollowUsers();
    }

    /**
     * ユーザーがフォローしたときに、中間テーブルにレコード作成
     *
     * @param integer $userId
     * @return JsonResponse
     */
    public function follow(int $userId)
    {
        $user = Auth::user();
        $followUser = $this->userRepository->getUserById($userId);
        $user->followings()->detach($followUser);
        $user->followings()->attach($followUser);

        return response()->json(null, Response::HTTP_CREATED);
    }

    /**
     * ユーザーがフォローを外したときに、中間テーブルのレコード削除
     *
     * @param integer $userId
     * @return JsonResponse
     */
    public function unfollow(int $userId)
    {
        $user = Auth::user();
        $followUser = $this->userRepository->getUserById($userId);
        $user->followings()->detach($followUser);

        return response()->json(null, Response::HTTP_CREATED);
    }
}
