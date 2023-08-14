<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page{

    /**
     * Metodo responsavel por renderizar o topo da página
     *
     * @return string
     */
    private static function getHeader(){
        return View::render('pages/header');
    }

    /**
     * Metodo responsavel por renderizar o rodapé da página
     *
     * @return string
     */
    private static function getFooter(){
        return View::render('pages/footer');
    }

    /**
     * Metodo responsavel por renderizar o layout de paginação
     *
     * @param Request $request
     * @param Pagination $obPagination
     * @return string
     */
    public static function getPagination($request, $obPagination){
        //OBTER AS PAGINAS
        $pages = $obPagination->getPages();
        
        //VERIFICA A QUANTIDADE DE PAGINAS
        if (count($pages) <=1) return '';

        //LINKS
        $links = '';
        
        //URL ATUAL (SEM GET)
        $url = $request->getRouter()->getCurrentUrl();

        //GET
        $querryParams = $request->getQueryParams();

        //RENDERIZA OS LINKS
        foreach ($pages as $page) {
            //ALTERA A PAGINA
            $querryParams['page'] = $page['page'];
            
            //LINK
            $link =$url.'?'.http_build_query($querryParams);

            //VIEW
            $links.=View::render('pages/pagination/link', [
                'page' => $page['page'],
                'link' => $link,
                'active' => $page ['current'] ? 'active' : ''
            ]);
        }

        //RENDERIZA BOX DE PAGINAÇÃO
        return View::render('pages/pagination/box', [
            'links' => $links
        ]);
    }
    
    /**
     * Metodo resonsavel por retornar o conteudo (view) da nossa pagina generica
     * @return string
     */
    public static function getPage($title, $content){
        return View::render('pages/page', [
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }
}