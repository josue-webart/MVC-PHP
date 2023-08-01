<?php

namespace App\Controller\Admin;

use App\Utils\View;

class Page{

    /**
     * Metodo responsavel por retorna o conteudo (view) da estrutura generica da pagina do painel
     * @param string $title
     * @param string $content
     * @return string
     */
    public static function getPage($title, $content){
        return View::render('admin/page',[
            'title' => $title,
            'content' => $content
        ]);

    }

}