<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EncryptRequest
{
    //
    public function handle(Request $request, Closure $next)
    {
//        return base64_decode("c3VyZQ==");
        return $next($request);
    }
}
