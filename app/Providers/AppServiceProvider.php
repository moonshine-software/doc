<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Vite::useScriptTagAttributes([
            'async' => true,
            'rel="prefetch" as' => 'script',
        ]);

        Vite::useStyleTagAttributes([
            'rel="preload" as' => 'style',
        ]);
    }
}
