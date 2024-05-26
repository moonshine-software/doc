<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RedirectServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Route::get('/docs/section/{page}', function ($page) {
            return redirect(to_page(page: $page), 301);
        })
            ->where('page', '!dashboard');

        Route::get('/docs/resource/icons/icons', function () {
            return redirect(to_page(page: 'icons'), 301);
        });
    }
}
