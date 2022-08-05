<?php

namespace App\Repositories\Tag;

use App\Models\Tag;

interface TagRepositoryInterface
{
    public function getTagById(int $tagId): Tag;
}
