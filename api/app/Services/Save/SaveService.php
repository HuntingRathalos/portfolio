<?php

namespace App\Services\Save;

use App\Models\Save;
use App\Repositories\Save\SaveRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SaveService implements SaveServiceInterface
{
    private $saveRepository;

    /**
     * @param SaveRepositoryInterface $saveRepository
     */
    public function __construct(SaveRepositoryInterface $saveRepository)
    {
        $this->saveRepository = $saveRepository;
    }

    public function getAllSaves(): JsonResponse
    {
        $allSaves = $this->saveRepository->getAllSaves();
        return response()->json($allSaves, Response::HTTP_OK);
    }
    /**
     * カレンダーを表示している1ヶ月分の貯金記録を取得し、responseをjsonに整形
     *
     * @param string $clickedDate
     * @return JsonResponse
     */
    public function getSavesOneMonth(string $clickedDate): JsonResponse
    {
        // フロントから送られてきた日付から月初、月末を取得
        $cb1 = new Carbon($clickedDate);
        $dateFrom = $cb1->startOfMonth()->toDateString();
        $cb2 = new Carbon($clickedDate);
        $dateTo = $cb2->endOfMonth()->toDateString();

        $savesOfOneMonth = $this->saveRepository->getSavesOneMonth($dateFrom, $dateTo);

        return response()->json($savesOfOneMonth, Response::HTTP_OK);
    }

    /**
     * 新たな貯金記録を作成し、responseをjsonに整形
     *
     * @param array $saveDetails
     * @return JsonResponse
     */
    public function createSave(array $saveDetails): JsonResponse
    {
        $save = $this->saveRepository->createSave($saveDetails);
        return response()->json($save, Response::HTTP_CREATED);
    }

    /**
     * 貯金記録を更新し、responseをjsonに整形
     *
     * @param integer $saveId
     * @param array $saveDetails
     * @return JsonResponse
     */
    public function updateSave(int $saveId, array $saveDetails): JsonResponse
    {
        $this->saveRepository->updateSave($saveId, $saveDetails);
        return response()->json($this->saveRepository->getSaveById($saveId), Response::HTTP_CREATED);
    }

    /**
     * 貯金記録を削除し、responseをjsonに整形
     *
     * @param integer $saveId
     * @return JsonResponse
     */
    public function deleteSave(int $saveId): JsonResponse
    {
        $this->saveRepository->deleteSave($saveId);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
