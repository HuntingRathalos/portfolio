<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Post\PostServiceInterface;
use App\Models\Post;

class PostController extends Controller
{
    private $postService;

    /**
     * @param PostServiceInterface $postService
     */
    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }
    /**
     * 振り返り投稿を全件取得して返却
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->postService->getAllPosts();
    }

    /**
     * ユーザーがお気に入りしている振り返り投稿を取得して返却
     *
     * @return \Illuminate\Http\Response
     */
    public function getLikePosts()
    {
        return $this->postService->getLikePosts();
    }

    /**
     * 新たな振り返り投稿を作成して返却
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->postService->createPost($request->all());
    }

    /**
     * ID番目の振り返り投稿を取得して返却
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return $this->postService->getPostById($id);
    }

    /**
     * 振り返り投稿を更新して返却
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        return $this->postService->updatePost($id, $request->all());
    }

    /**
     * 振り返り投稿を削除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return $this->postService->deletePost($id);
    }

    /**
     * 振り返り投稿をお気に入り登録して返却
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function like(int $id)
    {
        return $this->postService->likePost($id);
    }

    /**
     * 振り返り投稿のお気に入りを解除
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function unlike(int $id)
    {
        return $this->postService->unlikePost($id);
    }
}
