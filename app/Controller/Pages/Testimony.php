<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

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
}