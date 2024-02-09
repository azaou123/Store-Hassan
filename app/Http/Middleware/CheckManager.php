<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckManager
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('manager')) {
            return redirect('/');
        }

        return $next($request);
    }
}