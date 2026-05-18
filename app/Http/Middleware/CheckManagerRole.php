<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckManagerRole
{
    /**isso aqui serve pra verificar se usuario é gerente ou não
     * 
     * 
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {       
        //verificação de autenticação
        if (!auth()->check()){
            return redirect()->route('login');
        }

        //verificação de gerente
        if (!auth()->check()){
            abort(403, 'Area exclusiva do gerente');
        }
        return $next($request);
    }
}
