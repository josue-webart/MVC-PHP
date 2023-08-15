<?php

namespace App\Controller\Api;

use \App\Model\Entity\Testimony as EntityTestimony;
use \WilliamCosta\DatabaseManager\Pagination;

class Testimony extends Api
{

    /**
     * Metodo responsavel por obter a renderizçao dos itens de depoimentos para a pagina
     * @param Request $request
     * @param Pagination $obPagination
     * @return String
     */
    private static function getTestimoniesItems($request, &$obPagination)
    {
        //DEPOIMENTOS
        $itens = [];

        //QUANTIDADE TOTAL DE REGISTROS
        $quantidadeTotal = EntityTestimony::getTestimonies(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        //PAGINA ATUAL
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //INSTANCIA DE PAGINAÇÃO
        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 5);

        //RESULTADOS DA PAGINA
        $results = EntityTestimony::getTestimonies(null, 'id DESC', $obPagination->getLimit());

        //REDERIZA O ITEM
        while ($obTestimony = $results->fetchObject(EntityTestimony::class)) {

            $itens [] = [
                'id'       => (int) $obTestimony->id,
                'nome'     => $obTestimony->nome,
                'mensagem' => $obTestimony->mensagem,
                'data'     => $obTestimony->data
            ];
        }

        //RETORNA OS DEPIMENTOS
        return $itens;
    }

    /**
     * Metodo responsavel por retornar os depoimentos cadastrados
     *
     * @param Request $request
     * @return array
     */
    public static function getTestimonies($request)
    {
        return [
            'depoimentos' => self::getTestimoniesItems($request, $obPagination),
            'paginacao' => parent::getPagination($request, $obPagination)
        ];
    }

    /**
     * Metodo responsavel por retornar os detalhes de um depoimento
     * @param Request $request
     * @param integer $id
     * @return array
     */
    public static function getTestimony($request, $id){
        //VALIDA O ID DO DEPOIMENTO
        if (!is_numeric($id)) {
            throw new \Exception("O id '".$id."' nao é valido", 400); 
        }

        //BUSCA DEPOIMENTO
        $obTestimony = EntityTestimony::getTestimonyById($id);
        
        //VALIDA SE O DEPOIMENTO EXISTE
        if(!$obTestimony instanceof EntityTestimony){
            throw new \Exception("O depoimento ".$id." nao foi encontrado", 404); 
        }

        //RETORNA OS DETALHES DO DEPOIMENTO
        return [
            'id'       => (int) $obTestimony->id,
            'nome'     => $obTestimony->nome,
            'mensagem' => $obTestimony->mensagem,
            'data'     => $obTestimony->data
        ];
    }
}
