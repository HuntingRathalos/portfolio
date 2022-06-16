<?php

namespace App\Services\News;

use Illuminate\Http\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class NewsService implements NewsServiceInterface
{
  /**
   * クエリで送られてきたカテゴリーのニュースをNewsAPIから取得
   *
   * @param string $category
   * @return JsonResponse
   */
  public function getNewsByCategory(string $category): JsonResponse
  {
    try {
        $url = config('newsapi.news_api_url') . "top-headlines?country=jp&category=".$category."&apiKey=" . config('newsapi.news_api_key');
        $method = "GET";
        $count = 12;

        $client = new Client();
        $response = $client->request($method, $url);

        $jsonResult = $response->getBody();
        $result = json_decode($jsonResult, true);

        $articles = $result['articles'];

        $news = [];

        for ($id = 0; $id < $count; $id++) {
            array_push($news, [
                'title' => mb_substr($articles[$id]['title'], 0, 40),
                'description' => mb_substr($articles[$id]['description'], 0, 60)."...",
                'url' => $articles[$id]['url'],
                'thumbnail' => $articles[$id]['urlToImage'],
            ]);
        }
        return response()->json($news, Response::HTTP_OK);

    } catch (ConnectException $e) {
        Log::error($e);
        return response()->error(Response::HTTP_INTERNAL_SERVER_ERROR, '接続がうまくできませんでした。時間を置いて再度お試しください。');
    } catch (TransferException $e) {
        Log::error($e);
        return response()->error(Response::HTTP_INTERNAL_SERVER_ERROR, 'システムエラーが発生しました。時間を置いて再度お試しください。');
    }
  }
}
