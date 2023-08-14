<?php

namespace App\Controller\Admin;

use App\Utils\View;

class Page{

    /**
     * Modulos disponiveis no painel
     *@var array
     */
    private static $modules = [
        'home' => [
            'label' => 'Home',
            'link' => URL.'/admin'
        ],
        'testimonies' => [
            'label' => 'Depoimentos',
            'link' => URL.'/admin/testimonies'
        ],
        'users' => [
            'label' => 'Usuarios',
            'link' => URL.'/admin/users'
        ]
    ];

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

    /**
     * Metodo responsavel por renderizar a view do menu do painel
     * @param string $currentModule
     * @return string
     */
    private static function getMenu($currentModule){
        //LINKS DO MENU
        $links = '';

        //ITERA OS MODULOS
        foreach(self::$modules as $hash =>$module){
            $links .= View::render('admin/menu/link', [
                'label' => $module['label'],
                'link' => $module['link'],
                'current' => $hash == $currentModule ? 'text-danger': ''
            ]);
        }


        //RETORNA A RENDIRIZAÇÃO DO MENU
        return View::render('admin/menu/box', [
            'links' => $links

        ]);
    }

    /**
     * Metodo responsavel de renderizar a view do painel com conteudos dinamicos
     * @param string $title
     * @param string $content
     * @param string $currentModule
     * @return string
     */
    public static function getPanel($title, $content, $currentModule){
        //RENDERIZA A VIEW DO PAINEL
        $contentPanel = View::render('admin/panel',[
            'menu' => self::getMenu($currentModule),
            'content' => $content
        ]);


        //RETORNA A PAGINA RENDERIZADA
        return self:: getPage($title, $contentPanel);

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
        $querryparams = $request->getQueryParams();

        //RENDERIZA OS LINKS
        foreach ($pages as $page) {
            //ALTERA A PAGINA
            $querryparams['page'] = $page['page'];
            
            //LINK
            $link =$url.'?'.http_build_query($querryparams);

            //VIEW
            $links.=View::render('admin/pagination/link', [
                'page' => $page['page'],
                'link' => $link,
                'active' => $page ['current'] ? 'active' : ''
            ]);
        }

        //RENDERIZA BOX DE PAGINAÇÃO
        return View::render('admin/pagination/box', [
            'links' => $links
        ]);
    }

}