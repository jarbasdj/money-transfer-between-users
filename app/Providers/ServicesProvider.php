<?php

namespace App\Providers;

use App\Services\Contracts\ServiceInterface;
use App\Services\TransactionService;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(ServiceInterface::class, TransactionService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
    }
}
