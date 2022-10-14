<?php

namespace Tests\Unit\Repositories;

use App\Models\Post;
use App\Models\User;
use App\Repositories\Post\PostRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        //  依存解決しながらリポジトリ取得
        $this->repo = $this->app->make(PostRepository::class);
    }

    public function testGetPostById()
    {
        // IDを指定したレコードをあらかじめ作成
        $postId = 50;
        Post::factory()->create([
            'id' => $postId,
        ]);

        $post = $this->repo->getPostById($postId);

        // getPostByIdの返り値がPostインスタンスであることを確認
        $this->assertInstanceOf(Post::class, $post);
    }

    public function testGetAllPosts()
    {
        // あらかじめレコードを作成
        $save = Post::factory()->count(5)->create();

        $posts = $this->repo->getAllPosts();

        // 取得したレコードの数が正しいことを確認
        $recordNum = $posts->count();
        $this->assertSame(5, $recordNum);
        // 返り値がcollectionであることを確認
        $this->assertInstanceOf(Collection::class, $posts);
    }

    public function testCreatePost()
    {
        // 認証済みユーザー作成
        $user = User::factory()->create();
        $this->actingAs($user);

        // 新しい投稿作成用データ作成
        $postDetails = [
            'user_id' => $user->id,
            'good_description' => '良かった点',
            'bad_description' => '悪かった点',
            'self_evaluation' => 3,
        ];
        $createdPost = $this->repo->createPost($postDetails);

        // DBに保存されていることを確認
        $this->assertDatabaseHas('posts', $postDetails);
        $this->assertInstanceOf(Post::class, $createdPost);
    }

    public function testUpdatePost()
    {
        // IDを指定したレコードをあらかじめ作成
        $postId = 100;
        Post::factory()->create([
            'id' => $postId,
        ]);

        // 記録更新用データ作成
        $postDetails = [
            'good_description' => '良かった点!',
        ];
        $updatedPost = $this->repo->updatePost($postId, $postDetails);

        // DBに更新済みレコードが保存されていること、返り値がtrueであることを確認
        $this->assertDatabaseHas('posts', $postDetails);
        $this->assertSame($updatedPost, true);
    }

    public function testDeletePost()
    {
        // IDを指定したレコードをあらかじめ作成
        $postId = 200;
        Post::factory()->create([
            'id' => $postId,
        ]);
        $this->repo->deletePost($postId);

        // 指定したIDのレコードがDBに存在しないことを確認
        $this->assertDatabaseMissing('posts', [
            'id' => $postId,
        ]);
    }

    public function testLikePost()
    {
        // ログインユーザー作成
        $user = User::factory()->create();
        $this->actingAs($user);

        // IDを指定したレコードをあらかじめ作成
        $postId = 300;
        Post::factory()->create([
            'id' => $postId,
        ]);

        $this->repo->likePost($postId);

        // DBに保存されていることを確認
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'post_id' => $postId,
        ]);
    }

    public function testUnlikePost()
    {
        // ログインユーザー作成
        $user = User::factory()->create();
        $this->actingAs($user);

        // IDを指定したレコードをあらかじめ作成
        $postId = 400;
        Post::factory()->create([
            'id' => $postId,
        ]);

        $this->repo->unlikePost($postId);

        // 指定したIDのレコードがDBに存在しないことを確認
        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'post_id' => $postId,
        ]);
    }
}
