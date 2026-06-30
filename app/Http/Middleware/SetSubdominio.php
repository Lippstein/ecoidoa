<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetSubdominio
{
    public function handle(Request $request, Closure $next): Response
    {
        // Captura o host atual (ex: ://dominio.com)
        $host = $request->getHost();

        // Divide o host pelos pontos
        $partes = explode('.', $host);

        // Verifica se existe um subdomínio (ex: mais de 2 partes em dominio.com)
        if (count($partes) > 2) {
            $subdominio = $partes[0];
            $request->attributes->set('subdominio', $subdominio);
            // Define a sessão chamada 'subdominio'
            session(['subdominio' => $subdominio]);
        }

        return $next($request);
    }
}
