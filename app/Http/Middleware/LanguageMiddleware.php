<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $lang = $request->header('Accept-Language');

        $availableLocales = ['en', 'ar'];
        if ($lang && in_array($lang, $availableLocales)) {
            App::setLocale($lang);
        } else {
            App::setLocale('en');
        }

        return $next($request);
    }
}