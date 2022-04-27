<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * エラーハンドリングを拡張する
     *
     * @param $request
     * @param Throwable $exception
     * @return void
     */
    public function render($request, Throwable $exception)
    {
        if($request->is('api/*')) {
            return $this->apiErrorResponse($request, $exception);
        }
        // apiエラー以外はここでエラーハンドリング
        return parent::render($request, $exception);
    }
    /**
     * Httpエラーの場合、レスポンスマクロを呼んでjsonレスポンスのフォーマット作成
     *
     * @param $request
     * @param Throwable $exception
     * @return void
     */
    private function apiErrorResponse($request, Throwable $exception)
    {
        if($this->isHttpException($exception)) {
            $statusCode = $exception->getStatusCode();

            switch($statusCode) {
                case 401:
                    return response()->error(Response::HTTP_UNAUTHORIZED, '認証エラーが発生しました。再度ログインし直してください。');
                case 403:
                    return response()->error(Response::HTTP_FORBIDDEN, '許可されていません。');
                case 404:
                    return response()->error(Response::HTTP_NOT_FOUND, 'ページが見つかりません。');
                case 500:
                    return response()->error(Response::HTTP_INTERNAL_SERVER_ERROR, 'システムエラーが発生しました。');
            }
        }
    }

}
