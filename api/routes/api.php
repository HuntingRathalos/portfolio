<?php

use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\SaveController;
use App\Http\Controllers\Api\TargetController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/healthcheck', function () {
    return response()->json(200);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('saves', SaveController::class)->except('show');
    Route::get('/saves/amount', [SaveController::class, 'getAllSavesAmount']);
    Route::get('/saves/week', [SaveController::class, 'getSavesOneWeek']);
    Route::get('/saves/tag', [SaveController::class, 'getSavesByTagId']);
    Route::get('/saves/ranking', [SaveController::class, 'getSaveRanking']);

    Route::apiResource('targets', TargetController::class)->except('show');

    Route::get('/posts/like', [PostController::class, 'getLikePosts']);
    Route::patch('/posts/like/{postId}', [PostController::class, 'like']);
    Route::delete('/posts/like/{postId}', [PostController::class, 'unlike']);
    Route::apiResource('posts', PostController::class);

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'getUsersExceptMyself']);
        Route::get('/follow', [UserController::class, 'getFollowUsers']);
        Route::patch('/follow/{userId}', [UserController::class, 'follow'])->name('users.follow');
        Route::delete('/follow/{userId}', [UserController::class, 'unfollow'])->name('users.unfollow');
    });

    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::patch('/{notificationId}', [NotificationController::class, 'read']);
        Route::delete('/{notificationId}', [NotificationController::class, 'delete']);
    });
});

Route::get('/news', [NewsController::class, 'index']);
