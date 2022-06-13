<?php

namespace App\Services\News;

use Illuminate\Http\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Http\JsonResponse;

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
        $paramCatecory = '';
        switch ($category) {
          case 'ビジネス':
            $paramCatecory = 'business';
            break;
          case  'エンターテイメント':
            $paramCatecory = 'entertainment';
            break;
          case  '健康':
            $paramCatecory = 'health';
            break;
          case  '科学':
            $paramCatecory = 'science';
            break;
          case  'スポーツ':
            $paramCatecory = 'sports';
            break;
          case  'テクノロジー':
            $paramCatecory = 'technology';
            break;
        }

        $url = config('newsapi.news_api_url') . "top-headlines?country=jp&category=' .$paramCatecory. '&apiKey=" . config('newsapi.news_api_key');
        $method = "GET";
        $count = 20;

        $client = new Client();
        $response = $client->request($method, $url);

        $jsonResult = $response->getBody();
        $result = json_decode($jsonResult, true);
        $articles = $result['articles'];

        $news = [];

        for ($id = 0; $id < $count; $id++) {
            array_push($news, [
                'title' => $articles[$id]['title'],
                'content' => $articles[$id]['content'],
                'url' => $articles[$id]['url'],
                'thumbnail' => $articles[$id]['urlToImage'],
            ]);
        }
        return response()->json($news, Response::HTTP_OK);

    } catch (ConnectException $e) {
        return response()->error(Response::HTTP_INTERNAL_SERVER_ERROR, '接続がうまくできませんでした。時間を置いて再度お試しください。');
    } catch (TransferException $e) {
        return response()->error(Response::HTTP_INTERNAL_SERVER_ERROR, 'システムエラーが発生しました。時間を置いて再度お試しください。');
    }
  }
}
