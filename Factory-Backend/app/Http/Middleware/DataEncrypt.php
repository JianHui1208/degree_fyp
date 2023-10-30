<?php

namespace App\Http\Middleware;

use Closure;
use App\Encryption\Encrypt;
use Illuminate\Http\Request;

class DataEncrypt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($next($request)->getStatusCode() === 422) {
            return $next($request);
        } else {
            $response = $next($request);
            $orgn_data = $response->getData();
            $en_data = Encrypt::encrypt2($orgn_data->response);
            $orgn_data->response = $en_data;
            return $orgn_data;
        }
    }
}
