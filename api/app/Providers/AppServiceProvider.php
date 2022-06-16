<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Save\SaveServiceInterface;
use App\Services\Target\TargetServiceInterface;
use App\Services\User\UserServiceInterface;
use App\Services\News\NewsServiceInterface;
use App\Services\Save\SaveService;
use App\Services\Target\TargetService;
use App\Services\User\UserService;
use App\Services\News\NewsService;
use App\Repositories\Save\SaveRepositoryInterface;
use App\Repositories\Tag\TagRepositoryInterface;
use App\Repositories\Target\TargetRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Icon\IconRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->bind(
            SaveServiceInterface::class,
            function ($app) {
                return new SaveService(
                    $app->make(SaveRepositoryInterface::class),
                    $app->make(TagRepositoryInterface::class),
                    $app->make(IconRepositoryInterface::class)
                );
            });

        $this->app->bind(
            TargetServiceInterface::class,
            function ($app) {
                return new TargetService(
                    $app->make(TargetRepositoryInterface::class)
                );
            });

        $this->app->bind(
            UserServiceInterface::class,
            function ($app) {
                return new UserService(
                    $app->make(UserRepositoryInterface::class),
                    $app->make(SaveRepositoryInterface::class),
                    $app->make(TargetRepositoryInterface::class),
                    $app->make(TagRepositoryInterface::class),
                );
            });

        $this->app->bind(NewsServiceInterface::class, NewsService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
