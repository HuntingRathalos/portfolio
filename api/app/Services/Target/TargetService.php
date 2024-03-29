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
     * 目標を取得し、responseをjsonに整形.
     *
     * @return JsonResponse
     */
    public function getTarget(): JsonResponse
    {
        $target = $this->targetRepository->getTarget();
        if ($target === null) {
            return response()->json('', Response::HTTP_OK);
        }

        return response()->json($target, Response::HTTP_OK);
    }

    /**
     * 新たな目標を作成し、responseをjsonに整形.
     *
     * @param array $targetDetails
     *
     * @return JsonResponse
     */
    public function createTarget(array $targetDetails): JsonResponse
    {
        $target = $this->targetRepository->createTarget($targetDetails);

        return response()->json($target, Response::HTTP_CREATED);
    }

    /**
     * 目標を更新し、responseをjsonに整形.
     *
     * @param int   $targetId
     * @param array $targetDetails
     *
     * @return JsonResponse
     */
    public function updateTarget(int $targetId, array $targetDetails): JsonResponse
    {
        $this->targetRepository->updateTarget($targetId, $targetDetails);

        return response()->json($this->targetRepository->getTargetById($targetId), Response::HTTP_CREATED);
    }

    /**
     * 目標を削除し、responseをjsonに整形.
     *
     * @param int $targetId
     *
     * @return JsonResponse
     */
    public function deleteTarget(int $targetId): JsonResponse
    {
        $this->targetRepository->deleteTarget($targetId);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
