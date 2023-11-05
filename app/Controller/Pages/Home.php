<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Home extends Page{

    /**
     * Metodo resonsavel por retornar o conteudo (view) da nossa home
     * @return string
     */
    public static function getHome(){

        $obOrganization = new Organization;


        //VIEW DA HOME
        $content = View::render('pages/home', [
            'name' => $obOrganization->name,
            'maps' =>View::render('pages/map', [])
        ]);


        //RETORNA A VIEW DA PAGINA
        return parent::getPage('HOME > English', $content);
    }
}