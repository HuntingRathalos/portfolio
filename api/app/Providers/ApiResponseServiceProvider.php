<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // validationエラー以外はこの形式で対応
        Response::macro('error', function (int $statusCode, string $message) {
            return response()->json([
                'statusCode' => $statusCode,
                'message' => $message,
            ], $statusCode);
        });
    }
}
