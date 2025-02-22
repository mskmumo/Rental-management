<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClientMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->usertype === 'client') {
            return $next($request);
        }
        
        return redirect('/')->with('error', 'Unauthorized access');
    }
}
