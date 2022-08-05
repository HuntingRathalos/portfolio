<?php

namespace App\Services\News;

use Illuminate\Http\JsonResponse;

interface NewsServiceInterface
{
    public function getNewsByCategory(string $category): JsonResponse;
}
