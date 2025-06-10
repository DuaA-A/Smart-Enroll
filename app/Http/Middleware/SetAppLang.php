<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetAppLang
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);
        
        if (!in_array($locale, config('app.available_locales'))) {
            $locale = config('app.locale', 'en');
            $path = $request->path();
            $newPath = $locale . '/' . ltrim(str_replace($request->segment(1), '', $path), '/');
            return redirect()->to($newPath);
        }
        
        App::setLocale($locale);
        return $next($request);
    }
}