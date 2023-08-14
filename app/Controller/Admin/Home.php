<?php

namespace App\Controller\Admin;

use App\Utils\View;


class Home extends Page{    

    /**
     * Metodo responsavel por rederizar a view de home do paine
     * @param Request $request
     * @return string
     */
    public static function getHome($request){
        //CONTEUDO DA HOME
        $content = View::render('admin/modules/home/index', []);

        //RETORNA A PAGINA COMPELTA
        return parent::getPanel('Home > English Just for You', $content, 'home');
    }

    
}

