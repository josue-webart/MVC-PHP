<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Testimony as EntityTestimony;
use \WilliamCosta\DatabaseManager\Pagination;

class Testimony extends Page{
    
    /**
     * Metodo responsavel por obter a renderizçao dos itens de depoimentos para a pagina
     * @param Request $request
     * @param Pagination $obPagination
     * @return String
     */
    private static function getTestimoniesItems($request, &$obPagination){
        //DEPOIMENTOS
        $itens='';

        //QUANTIDADE TOTAL DE REGISTROS
        $quantidadeTotal = EntityTestimony::getTestimonies(null, null, null,'COUNT(*) as qtd')->fetchObject()->qtd;
        
        //PAGINA ATUAL
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //INSTANCIA DE PAGINAÇÃO
        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 2);

        //RESULTADOS DA PAGINA
        $results = EntityTestimony::getTestimonies(null, 'id DESC', $obPagination->getLimit());

        //REDERIZA O ITEM
        while ($obTestimony = $results->fetchObject(EntityTestimony::class)) {
            
            $itens .= View::render('pages/testimony/item', [
            'nome' => $obTestimony->nome,
            'mensagem' => $obTestimony->mensagem,
            'data' => date('d/m/Y H:i:s', strtotime($obTestimony->data))
        ]);
        }

        //RETORNA OS DEPIMENTOS
        return $itens;
    }

    /**
     * Metodo resonsavel por retornar o conteudo (view) de Depoimentos
     * @param Request $request
     * @return string
     */
    public static function getTestimonies($request){
        //VIEW DE DEPOIMENTOS
        $content = View::render('pages/testimonies', [
            'itens'=> self::getTestimoniesItems($request,$obPagination),
            'pagination' => parent::getPagination($request, $obPagination)
        ]);

        //RETORNA A VIEW DA PAGINA
        return parent::getPage('DEPOIMENTO > English', $content);
    }


    /**
     * Metodo responsavel por cadastrar um depoimento
     * @param Request $request
     * @return string
     */
    public static function insertTestimony($request){
        //DADOS DO POST
        $postVars = $request->getPostVars();

        //NOVA INSTANCIA DE DEPOIMENTO
        $obTestimony = new EntityTestimony;
        $obTestimony->nome = $postVars['nome'];
        $obTestimony->mensagem = $postVars['mensagem'];
        $obTestimony->cadastrar();

        //RETORNA A PAGINA DE LISTAGEM DE DEPOIMENTOS
        return self::getTestimonies($request);
    }

}