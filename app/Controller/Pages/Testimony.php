<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Testimony as EntityTestimony;

class Testimony extends Page{

    /**
     * Metodo resonsavel por retornar o conteudo (view) de Depoimentos
     * @return string
     */
    public static function getTestimonies(){



        //VIEW DE DEPOIMENTOS
        $content = View::render('pages/testimonies', [

        ]);

        //RETORNA A VIEW DA PAGINA
        return parent::getPage('DEPIMENTO > English', $content);
    }


    /**
     * Metodo responsavel por cadastrar um depoimento
     * @param Request $request
     * @return string
     */
    public static function insertTestimny($request){
        //DADOS DO POST
        $postVars = $request->getPostVars();

        //NOVA INSTANCIA DE DEPOIMENTO
        $obTestimony = new EntityTestimony;
        $obTestimony->nome = $postVars['nome'];
        $obTestimony->mensagem = $postVars['mensagem'];
        $obTestimony->cadastrar();


        return self::getTestimonies();
    }

}