<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAjax
{

    public function handle(Request $request, Closure $next)
    {
        if (!$request->ajax()) {
            return response('Bad Request', 422);
        }

        return $next($request);
    }
}
