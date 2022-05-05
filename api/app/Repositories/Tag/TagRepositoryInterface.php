<?php

namespace App\Repositories\Tag;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

interface TagRepositoryInterface
{
    public function getTagById(int $tagId): Tag;
}
