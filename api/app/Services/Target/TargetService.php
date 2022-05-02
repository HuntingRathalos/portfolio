<?php

namespace App\Services\Target;

use App\Repositories\Target\TargetRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TargetService implements TargetServiceInterface
{
  private $targetRepository;

  /**
   * @param TargetRepositoryInterface $targetRepository
   */
  public function __construct(TargetRepositoryInterface $targetRepository)
  {
      $this->targetRepository = $targetRepository;
  }

  /**
   * 新たな目標を作成し、responseをjsonに整形
   *
   * @param array $targetDetails
   * @return JsonResponse
   */
  public function createTarget(array $targetDetails): JsonResponse
  {
    $target = $this->targetRepository->createTarget($targetDetails);
    return response()->json($target, Response::HTTP_CREATED);
  }

  /**
   * 目標を更新し、responseをjsonに整形
   *
   * @param integer $targetId
   * @param array $targetDetails
   * @return JsonResponse
   */
  public function updateTarget(int $targetId, array $targetDetails): JsonResponse
  {
    $this->targetRepository->updateTarget($targetId, $targetDetails);
    return response()->json($this->targetRepository->getTargetById($targetId), Response::HTTP_CREATED);
  }

  /**
   * 目標を削除し、responseをjsonに整形
   *
   * @param integer $targetId
   * @return JsonResponse
   */
  public function deleteTarget(int $targetId): JsonResponse
  {
    $this->targetRepository->deleteTarget($targetId);
    return response()->json(null, Response::HTTP_NO_CONTENT);
  }
}
