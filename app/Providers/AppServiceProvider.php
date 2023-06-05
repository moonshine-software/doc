<?php

namespace App\Providers;

use App\Services\PackageInfo\Contracts\PackageInfoServiceManagerContract;
use App\Services\PackageInfo\PackageInfoServiceManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(PackageInfoServiceManagerContract::class, function () {
            return new PackageInfoServiceManager();
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
