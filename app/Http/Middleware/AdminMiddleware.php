<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && auth()->user()->admin) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Acesso não autorizado.');
    }
}
