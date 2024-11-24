<?php

namespace App\Providers;

use App\Contracts\JobStorageInterface;
use App\Services\RedisJobStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(JobStorageInterface::class, RedisJobStorage::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
