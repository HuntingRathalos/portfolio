<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TargetRequest;
use App\Services\Save\SaveServiceInterface;
use App\Services\Target\TargetServiceInterface;
use Illuminate\Http\Response;

class TargetController extends Controller
{
    private $targetService;
    private $saveService;

    /**
     * @param TargetServiceInterface $targetService
     * @param SaveServiceInterface   $saveService
     */
    public function __construct(
        TargetServiceInterface $targetService,
        SaveServiceInterface $saveService,
    ) {
        $this->middleware('verify.notguest')->only('store', 'update', 'destroy');
        $this->targetService = $targetService;
        $this->saveService = $saveService;
    }

    /**
     *ユーザーに紐づく目標、貯金の合計額を取得.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->targetService->getTarget();
    }

    /**
     * 新たな目標を作成する.
     *
     * @param \Illuminate\Http\TargetRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TargetRequest $request)
    {
        $validated = $request->validated();

        return $this->targetService->createTarget($validated);
    }

    /**
     * 目標を更新する.
     *
     * @param \Illuminate\Http\TargetRequest $request
     * @param int                            $targetId
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TargetRequest $request, int $targetId)
    {
        $validated = $request->validated();

        return $this->targetService->updateTarget($targetId, $validated);
    }

    /**
     * 目標と貯金記録を全件削除.
     *
     * @param int $targetId
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $targetId)
    {
        \DB::transaction(function () use ($targetId) {
            $this->targetService->deleteTarget($targetId);
            $this->saveService->deleteAllSaves();
        });

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
