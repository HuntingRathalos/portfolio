<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Save\SaveServiceInterface;
use App\Models\Save;

class SaveController extends Controller
{
    private $saveService;

    /**
     * @param SaveServiceInterface $saveService
     */
    public function __construct(SaveServiceInterface $saveService)
    {
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->saveService->createSave($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $saveId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $saveId)
    {
        return $this->saveService->updateSave($saveId, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $saveId
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $saveId)
    {
        return $this->saveService->deleteSave($saveId);
    }
}
