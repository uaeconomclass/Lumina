<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Page;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Spatie\Translatable\Facades\Translatable;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Relation::enforceMorphMap([
            'page' => Page::class,
        ]);

        RateLimiter::for('api', static function (Request $request): Limit {
            return Limit::perMinute(120)->by($request->user()?->getAuthIdentifier() ?: $request->ip());
        });

        Translatable::fallback(
            fallbackLocale: config('app.fallback_locale', 'en'),
            fallbackAny: true,
        );
    }
}
