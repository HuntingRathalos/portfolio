<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    public function getPostById($postId): Post;
    public function getAllPosts(): Collection;
    public function getLikePosts(): Collection;
    public function createPost(array $postDetails): Post;
    public function updatePost(int $postId, array $postDetails): bool;
    public function deletePost(int $postId): void;
    public function likePost(int $postId): void;
    public function unlikePost(int $postId): void;
}
