<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Target\TargetServiceInterface;
use App\Services\Save\SaveServiceInterface;
use Illuminate\Support\Facades\Auth;

class TargetController extends Controller
{
    private $targetService;
    private $saveService;

    /**
     * @param TargetServiceInterface $targetService
     * @param SaveServiceInterface $saveService
     */
    public function __construct(
        TargetServiceInterface $targetService,
        SaveServiceInterface $saveService,
        )
    {
        $this->targetService = $targetService;
        $this->saveService = $saveService;
    }

    /**
     *ユーザーに紐づく目標、貯金の合計額を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $target = $this->targetService->getTarget();
        $amount = $this->saveService->getAllSavesAmount();

        return [$target, $amount];
    }

    /**
     * 新たな目標を作成する
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->targetService->createTarget($request->all());
    }

    /**
     * 目標を更新する
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $targetId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $targetId)
    {
        return $this->targetService->updateTarget($targetId, $request->all());
    }

    /**
     * 目標と貯金記録を全件削除
     *
     * @param  int  $targetId
     * @return \Illuminate\Http\Response
     */
    public function destroy($targetId)
    {
        $this->targetService->deleteTarget($targetId);
        return $this->saveService->deleteAllSaves();
    }
}
