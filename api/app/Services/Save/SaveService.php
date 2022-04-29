<?php

namespace App\Services\Save;

use App\Models\Save;
use App\Repositories\Save\SaveRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

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

    /**
     * 貯金記録を全件取得
     *
     * @return JsonResponse
     */
    public function getAllSaves(): JsonResponse
    {
        $allSaves = $this->saveRepository->getAllSaves();
        return response()->json($allSaves, Response::HTTP_OK);
    }
    /**
     * 今週分の貯金記録を取得し、responseをjsonに整形
     *
     * @return JsonResponse
     */
    public function getSavesSpecificPeriod(): JsonResponse
    {
        // 週始めと週末の日付を取得
        $cb1 = new Carbon();
        $dateFrom = $cb1->startOfWeek()->toDateString();
        $cb2 = new Carbon();
        $dateTo = $cb2->endOfWeek()->toDateString();

        // 今週分の貯金記録取得
        $savesOfOneWeek = $this->saveRepository->getSavesSpecificPeriod($dateFrom, $dateTo);

        // $savesOfOneWeekにデータがない日用に配列を作成
        $period = CarbonPeriod::create($dateFrom, 7)->toArray();
        $dates = [];
        foreach($period as $date) {
            $dates[$date->format('Y-m-d')] = [
                'click_date' => $date->format('Y-m-d'),
                'pluscoin' => 0,
                'minuscoin' => 0
            ];
        }
        // 日毎にコインの数を合計して配列に格納
        if(!$savesOfOneWeek->isEmpty()) {
            $processedSaves = collect();
            $savesGroupByClickDate = $savesOfOneWeek->groupBy('click_date');
            $savesGroupByClickDate->each(function($saves, $key) use($processedSaves) {
                $pluscoin = 0;
                $minuscoin = 0;
                foreach($saves as $save) {
                     $save->coin > 0 ? $pluscoin += $save->coin : $minuscoin -= $save->coin;
                    }
                    $processedSaves[$key] = [
                        'click_date' => $key,
                        'pluscoin' => $pluscoin,
                        'minuscoin' => $minuscoin
                    ];
            });
            // データがない日用の配列とコインの数を合計して格納した配列をマージ
            $mergeSaves = array_replace($dates, $processedSaves->toArray());
            // フロントで扱いやすいようにデータを加工
            $result = [];
            foreach($mergeSaves as $mergeSave) {
                $result[] = $mergeSave;
            }
        }else {
            return response()->json($dates, Response::HTTP_OK);
        }

        return response()->json($result, Response::HTTP_OK);
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
