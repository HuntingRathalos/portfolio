<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Save\SaveRepositoryInterface;
use App\Repositories\Tag\TagRepositoryInterface;
use App\Repositories\Save\SaveRepository;
use App\Repositories\Tag\TagRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SaveRepositoryInterface::class, SaveRepository::class);

        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
