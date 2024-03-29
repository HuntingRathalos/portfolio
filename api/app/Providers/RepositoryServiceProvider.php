<?php

namespace App\Providers;

use App\Repositories\Icon\IconRepository;
use App\Repositories\Icon\IconRepositoryInterface;
use App\Repositories\Notification\NotificationRepository;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Repositories\Post\PostRepository;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Save\SaveRepository;
use App\Repositories\Save\SaveRepositoryInterface;
use App\Repositories\Tag\TagRepository;
use App\Repositories\Tag\TagRepositoryInterface;
use App\Repositories\Target\TargetRepository;
use App\Repositories\Target\TargetRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(SaveRepositoryInterface::class, SaveRepository::class);

        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);

        $this->app->bind(TargetRepositoryInterface::class, TargetRepository::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(IconRepositoryInterface::class, IconRepository::class);

        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);

        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
    }
}
