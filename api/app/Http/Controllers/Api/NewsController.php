<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\News\NewsServiceInterface;
use Illuminate\Http\Request;

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
     * クエリで送られてきたカテゴリーのニュースをNewsAPIから取得.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $category = $request->category;

        return $this->newsService->getNewsByCategory($category);
    }
}
