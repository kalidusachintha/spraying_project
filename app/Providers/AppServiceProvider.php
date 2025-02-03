<?php

namespace App\Providers;

use App\Interfaces\SprayingInterface;
use App\Repositories\SprayingsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(SprayingInterface::class, SprayingsRepository::class);
    }
}
