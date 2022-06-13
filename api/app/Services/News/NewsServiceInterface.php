<?php

namespace App\Services\News;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

interface NewsServiceInterface
{
    public function getNewsByCategory(string $category): JsonResponse;
}
