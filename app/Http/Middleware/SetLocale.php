<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locales = config('lumina.locales', ['en']);
        $routeLocale = $request->route('locale');
        $segmentLocale = $request->segment(1);

        $candidate = in_array($routeLocale, $locales, true)
            ? $routeLocale
            : (in_array($segmentLocale, $locales, true)
                ? $segmentLocale
                : $request->getPreferredLanguage($locales));

        $candidate ??= config('app.fallback_locale', 'en');

        App::setLocale($candidate);

        return $next($request);
    }
}
