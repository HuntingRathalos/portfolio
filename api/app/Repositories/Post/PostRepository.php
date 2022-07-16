<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PostRepository implements PostRepositoryInterface
{
  private $model;

  /**
   * @param Post $post
   */
  public function __construct(Post $post)
  {
      $this->model = $post;
  }

  /**
   * 振り返り投稿を1件取得
   *
   * @param int $postId
   * @return Post
   */
  public function getPostById($postId): Post
  {
      return $this->model->findOrFail($postId);
  }

  /**
   * 振り返り投稿を全件取得
   *
   * @return Collection
   */
  public function getAllPosts(): Collection
  {
       return $this->model::with('user')->get();
  }

  /**
   * お気に入りした振り返り記録を取得
   *
   * @return Collection
   */
  public function getLikePosts(): Collection
  {
      $likePosts = User::find(Auth::id())->likes;
      if(!$likePosts->isEmpty()) {
        return $likePosts->load('user');
      }
      return $likePosts;
  }

  /**
   * 新たな振り返り投稿を作成
   *
   * @param array $postDetails
   * @return Post
   */
  public function createPost(array $postDetails): Post
  {
    return $this->model->create([
        'user_id' => Auth::id(),
        'good_description' => $postDetails['good_description'],
        'bad_description' => $postDetails['bad_description'],
        'self_evaluation' => $postDetails['self_evaluation'],
        ]);
  }

  /**
   * 振り返り投稿を更新
   *
   * @param int $postId
   * @param array $postDetails
   * @return  bool
   */
  public function updatePost(int $postId, array $postDetails): bool
  {
      return $this->model->find($postId)->fill($postDetails)->save();
  }

  /**
   * 振り返り投稿の削除
   *
   * @param int $postId
   * @return void
   */
  public function deletePost(int $postId): void
  {
      $this->model->destroy($postId);
  }

  /**
   * 振り返り投稿のお気に入り
   *
   * @param integer $postId
   * @return void
   */
  public function likePost(int $postId): void
  {
    $post = $this->model->find($postId);
    $post->likes()->detach(Auth::id());
    $post->likes()->attach(Auth::id());
  }

  /**
   * 振り返り投稿のお気に入り解除
   *
   * @param integer $postId
   * @return void
   */
  public function unlikePost(int $postId): void
  {
    $post = $this->model->find($postId);
    $post->likes()->detach(Auth::id());
  }
}
