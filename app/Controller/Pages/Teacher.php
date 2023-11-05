<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Teacher as EntityTeacher;
use \WilliamCosta\DatabaseManager\Pagination;

class Teacher extends Page{
    
    /**
     * Metodo responsavel por obter a renderizçao dos itens de profesores para a pagina
     * @param Request $request
     * @param Pagination $obPagination
     * @return String
     */
    private static function getTeachersItems($request, &$obPagination){
        //PROFESORES
        $itens='';

        //QUANTIDADE TOTAL DE REGISTROS
        $quantidadeTotal = EntityTeacher::getTeachers(null, null, null,'COUNT(*) as qtd')->fetchObject()->qtd;
        
        //PAGINA ATUAL
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;
        
        //INSTANCIA DE PAGINAÇÃO
        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 2);

        //RESULTADOS DA PAGINA
        $results = EntityTeacher::getTeachers(null, null, $obPagination->getLimit());



        //REDERIZA O ITEM
        while ($obTeacher = $results->fetchObject(EntityTeacher::class)) {

            $class = ($obTeacher->id % 2 == 0) ? 'bg-light' : 'bg-secondary' ;
            
            $itens .= View::render('pages/teachers/teachers', [
            'nome' => $obTeacher->nome,
            'descricao' => $obTeacher->descricao,
            'foto' => $obTeacher->foto,
            'class' => $class
        ]);
        }
        

        //RETORNA OS DEPIMENTOS
        return $itens;
    }


    /**
     * Metodo resonsavel por retornar o conteudo (view) de Profesores
     * @param Request $request
     * @return string
     */
    public static function getTeachers($request){
        
        //VIEW DE DEPOIMENTOS
        $content = View::render('pages/about', [
            'name'       => 'Teachers',
            'itens'      => self::getTeachersItems($request,$obPagination),
            'pagination' => parent::getPagination($request, $obPagination)
        ]);

        //RETORNA A VIEW DA PAGINA
        return parent::getPage('TEACHERS > English', $content);
    }


}