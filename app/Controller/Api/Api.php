<?php

namespace App\Controller\Api;

class Api
{

    /**
     * Metodo responsavel por retornar os detalhes da API
     *
     * @param Request $request
     * @return array
     */
    public static function getDetails($request)
    {
        return [
            'nome' => 'API - ENGLISH JUST FOR YOU',
            'versao' => 'v1.0.0',
            'autor' => 'William Costa',
            'email' => 'josue@projetomvc.com'
        ];
    }

    /**
     * Metodo responsavel por retornar os detalhes da paginação
     *
     * @param Request $request
     * @param Pagination $obPagination
     * @return array
     */
    protected static function getPagination($request, $obPagination)
    {
        //QUERRY PARAMS
        $querryparams = $request->getQueryParams();

        //OBTER AS PAGINAS
        $pages = $obPagination->getPages();

        //RETORNO
        return [
            'paginaAtual'          => isset($querryparams['page']) ? (int) $querryparams['page'] : 1,
            'quantidadePagination' => !empty($pages) ? count($pages) : 1
        ];
    }
}
