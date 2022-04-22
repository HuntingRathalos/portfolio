<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Save\SaveServiceInterface;
use App\Services\Save\SaveService;
use App\Repositories\Save\SaveRepositoryInterface;

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
                    $app->make(SaveRepositoryInterface::class)
                );
            });
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
