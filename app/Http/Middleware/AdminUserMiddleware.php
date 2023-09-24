<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUserMiddleware
{
    //
    public function handle(Request $request, Closure $next)
    {
        $email = Session::get('userid');

        if (!in_array($email, ['axayhg@gmail.com', 'dhirendrakumarpandey29@gmail.com'])) {
            return abort(404);
        }

        return $next($request);
    }
}
