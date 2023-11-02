<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
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
