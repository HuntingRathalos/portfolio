<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\News\NewsServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\TransferException;

class NewsController extends Controller
{
    private $newsService;

    /**
     * @param NewsServiceInterface $newsService
     */
    public function __construct(NewsServiceInterface $newsService)
    {
        $this->newsService = $newsService;
    }

    /**
     * クエリで送られてきたカテゴリーのニュースをNewsAPIから取得
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $category = $request->category;

        return $this->newsService->getNewsByCategory($category);
    }
}
