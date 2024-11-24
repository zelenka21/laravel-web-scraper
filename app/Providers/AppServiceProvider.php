<?php

namespace App\Providers;

use App\Contracts\JobStorageInterface;
use App\Services\RedisJobStorage;
use App\Services\WebScraperService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(JobStorageInterface::class, RedisJobStorage::class);

        $this->app->singleton(Client::class, function () {
            return new Client([
                'timeout' => 30,
                'headers' => [
                    'User-Agent' =>'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
                ],
                'http_errors' => true
            ]);
        });

        $this->app->singleton(WebScraperService::class, function ($app) {
            return new WebScraperService($app->make(Client::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
