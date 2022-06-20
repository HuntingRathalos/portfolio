<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SaveController;
use App\Http\Controllers\Api\TargetController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::get('/store/s', function() {
//     return response()->json(['name' => '山田太郎', 'gender' => '男','mail' => 'yamada@test.com']);
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::apiResource('saves', SaveController::class)->except('show');
    Route::get('/saves/amount', [SaveController::class, 'getAllSavesAmount']);
    Route::get('/saves/week', [SaveController::class, 'getSavesOneWeek']);
    Route::get('/saves/tag', [SaveController::class, 'getSavesByTagId']);
    Route::get('/saves/ranking', [SaveController::class, 'getSaveRanking']);

    Route::apiResource('targets', TargetController::class)->except('show');

    Route::apiResource('posts', PostController::class);
    Route::get('/posts/like', [PostController::class, 'getLikePosts']);
    Route::patch('/posts/like/{postId}', [PostController::class, 'like']);
    Route::delete('/posts/like/{postId}', [PostController::class, 'unlike']);

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'getUsersExceptMyself']);
        Route::get('/follow', [UserController::class, 'getFollowUsers']);
        Route::patch('/follow/{userId}', [UserController::class, 'follow'])->name('users.follow');
        Route::delete('/follow/{userId}', [UserController::class, 'unfollow'])->name('users.unfollow');
    });
  });

  Route::get('/news', [NewsController::class, 'index']);
