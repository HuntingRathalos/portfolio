<?php

namespace App\Services\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

interface PostServiceInterface
{
    public function getPostById(int $postId) :JsonResponse;
    public function getAllPosts(): JsonResponse;
    public function getLikePosts(): JsonResponse;
    public function createPost(array $postDetails): JsonResponse;
    public function updatePost(int $postId, array $postDetails): JsonResponse;
    public function deletePost(int $postId): JsonResponse;
    public function likePost(int $postId): JsonResponse;
    public function unlikePost(int $postId): JsonResponse;
}
