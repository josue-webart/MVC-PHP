<?php

namespace App\Http\Middleware;

class Api{

    /**
     * Metodo responsavel por executar o middleware
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, $next){
        //ALTERA CONTENT TYPE PARA JSON
        $request->getRouter()->setContentType('application/json');

        //EXECUTA O PROXIMO NIVEL DO MIDDLEWARE
        return $next($request);
    }

}