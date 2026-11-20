<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

  public function boot(): void
{
    $appUrl = config('app.url');
    $host = parse_url($appUrl, PHP_URL_HOST) ?? '';

    if (str_ends_with($host, '.app.github.dev')) {
        URL::useOrigin($appUrl);
        URL::forceScheme('https');
    }
    }
}