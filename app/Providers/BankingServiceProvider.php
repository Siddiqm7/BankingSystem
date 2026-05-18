<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\AccountServiceInterface;
use App\Services\AccountService;

class BankingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            AccountServiceInterface::class,
            AccountService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
    }
}
