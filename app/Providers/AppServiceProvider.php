<?php

namespace App\Providers;

use App\Actions\Readme;
use App\Actions\Readme\Contracts\ReadmeContract;
use App\Support\PackageInfo\Contracts\PackageInfoContract;
use App\Support\PackageInfo\PackageInfo;
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
        $this->app->bind(PackageInfoContract::class, PackageInfo::class);
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
