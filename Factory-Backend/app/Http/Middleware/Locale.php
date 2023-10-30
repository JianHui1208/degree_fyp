<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Locale
{
    /**
     * Handle an incoming request.
     * 语言中间件
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $default_lang = "en_US";

        $allowed_lang = ['en_US', 'zh_CN'];

        if ($request->has("locale") && in_array($request->input("locale"), $allowed_lang)) {
            App::setLocale($request->input("locale"));
        } else {
            App::setLocale($default_lang);
        }

        return $next($request);
    }
}
