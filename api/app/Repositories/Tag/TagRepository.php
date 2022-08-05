<?php

namespace App\Repositories\Tag;

use App\Models\Tag;

class TagRepository implements TagRepositoryInterface
{
    private $model;

    /**
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    /**
     * idからタグコードを1件取得.
     *
     * @param int $tagId
     *
     * @return Tag
     */
    public function getTagById(int $tagId): Tag
    {
        return $this->model->findOrFail($tagId);
    }
}
