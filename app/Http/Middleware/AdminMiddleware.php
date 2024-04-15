<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verifique se o usuário está autenticado e é um administrador
        if(auth()->check() && auth()->user()->admin) {
            return $next($request);
        }

        // Redirecione para casa ou exiba uma mensagem de erro
        return redirect()->route('home')->with('error', 'Acesso não autorizado.');
    }
}
