<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserType {

    public function handle($request, Closure $next) {
        // Verifique se o usuário está autenticado
        if (auth()->check()) {
            $userType = auth()->user()->type;

            // Verifique se o tipo do usuário é 1
            if ($userType == 1) {
                // Usuário tem permissão, prossiga
                return $next($request);
            }
        }

        // Usuário não tem permissão, redirecione ou retorne uma resposta adequada
        return redirect()->route('admin');
    }
}

