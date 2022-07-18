<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveRequest;
use App\Services\Save\SaveServiceInterface;

class SaveController extends Controller
{
    private $saveService;

    /**
     * @param SaveServiceInterface $saveService
     */
    public function __construct(SaveServiceInterface $saveService)
    {
        $this->middleware('verify.notguest')->only('store', 'update', 'destroy');
        $this->saveService = $saveService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->saveService->getAllSaves();
    }

    /**
     * 合計貯金額を返す.
     */
    public function getAllSavesAmount()
    {
        return $this->saveService->getAllSavesAmount();
    }

    /**
     * 1週間分の貯金記録取得し、グラフ用にデータを整形して返す.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSavesOneWeek()
    {
        return $this->saveService->getSavesSpecificPeriod();
    }

    /**
     * 全貯金記録をタグでグループ化し、円グラフ用にデータを整形して返す.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSavesByTagId()
    {
        return $this->saveService->getSavesByTagId();
    }

    /**
     * ランキング用のデータをtag_idでグループ化して取得.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSaveRanking()
    {
        return $this->saveService->getSaveRanking();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\SaveRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRequest $request)
    {
        $validated = $request->validated();

        return $this->saveService->createSave($validated);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\SaveRequest $request
     * @param int                          $saveId
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SaveRequest $request, int $saveId)
    {
        $validated = $request->validated();

        return $this->saveService->updateSave($saveId, $validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $saveId
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $saveId)
    {
        return $this->saveService->deleteSave($saveId);
    }
}
