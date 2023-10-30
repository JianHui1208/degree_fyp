<?php

namespace App\Http\Middleware;

use Closure;
use App\Encryption\Decrypt;
use Illuminate\Http\Request;

class DataDecrypt
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
        if (empty($request->data)) {
            return $next($request);
        }

        $orgn_data = Decrypt::decrypt2($request->data);

        if ($orgn_data === 9999 || $orgn_data === null) {
            return response()->json(['status' => 9999, 'msg' => 'Data Decrypt Error']);
        }

        $request->merge((array)$orgn_data);
        unset($request['data']);

        return $next($request);
    }
}
