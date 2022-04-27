<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Save\SaveRepositoryInterface;
use App\Repositories\Save\SaveRepository;

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
