<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckManagerRole
{
    /**
     * Verifica se o usuário é gerente ou admin
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {       
        // 1. Verifica se está autenticado
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Você precisa estar logado.');
        }

        // 2. Verifica se é gerente ou admin
        if (!auth()->user()->isManager()) {
            abort(403, 'Acesso negado. Esta área é exclusiva para gerentes.');
        }

        return $next($request);
    }
}
