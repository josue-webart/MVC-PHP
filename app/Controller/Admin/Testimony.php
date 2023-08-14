<?php

namespace App\Controller\Admin;

use App\Utils\View;
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
        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 3);

        //RESULTADOS DA PAGINA
        $results = EntityTestimony::getTestimonies(null, 'id DESC', $obPagination->getLimit());

        //REDERIZA O ITEM
        while ($obTestimony = $results->fetchObject(EntityTestimony::class)) {
            
            $itens .= View::render('admin/modules/testimonies/item', [
            'id'       => $obTestimony->id,
            'nome'     => $obTestimony->nome,
            'mensagem' => $obTestimony->mensagem,
            'data'     => date('d/m/Y H:i:s', strtotime($obTestimony->data))
        ]);
        }

        //RETORNA OS DEPIMENTOS
        return $itens;
    }

    /**
     * Metodo responsavel por rederizar a view de listagem de depoimentos
     * @param Request $request
     * @return string
     */
    public static function getTestimonies($request){
        //CONTEUDO DA HOME
        $content = View::render('admin/modules/testimonies/index', [
            'itens'      => self::getTestimoniesItems($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination),
            'status'     =>self::getStatus($request)
        ]);

        //RETORNA A PAGINA COMPELTA
        return parent::getPanel('Depoimentos > English Just for You', $content, 'testimonies');
    }

    /**
     * Metodo responsavel por retorna o formulario de cadastro de um novo depoimento
     * @param Request $request
     * @return string
     */
    public static function getNewTestimony($request){
        //CONTEUDO DO FORMULARIO
        $content = View::render('admin/modules/testimonies/form', [
            'tittle'   => 'Cadastrar Depoimento',
            'nome'     =>'',
            'mensagem' => '',
            'status'   => ''
        ]);

        //RETORNA A PAGINA COMPELTA
        return parent::getPanel('Cadastro de Depoimento > Admin', $content, 'testimonies');
    }

    /**
     * Metodo responsavel por cadastrar um depoimento
     * @param Request $request
     * @return string
     */
    public static function setNewTestimony($request){
        //DADOS DO POST
        $postVars = $request->getPostVars();
        
        //NOVA INSTANCIA DE DEPOIMENTO
        $obTestimony = new EntityTestimony;
        $obTestimony->nome = $postVars['nome'];
        $obTestimony->mensagem = $postVars['mensagem'];
        $obTestimony->cadastrar();

        //REDIRECIONA O USUARIO
        $request->getRouter()->redirect('admin/testimonies/'.$obTestimony->id.'/edit?status=created');
        
    }

    /**
     * Metodo responsavel por retornar a mensagem de status 
     * @param Request $request
     * @return string
     */
    private static function getStatus($request){
        //QUERY PARAMS
        $queryParams = $request->getQueryParams();

        //STATUS
        if (!isset($queryParams['status'])) return '';

        //MESAGENS DE STATUS
        switch ($queryParams['status']) {
            case 'created':
                return Alert::getSuccess('Depoimento criado com sucesso!');
                break;
            case 'updated':
                return Alert::getSuccess('Depoimento atualizado com sucesso!');
                break;
            case 'deleted':
                return Alert::getSuccess('Depoimento excluido com sucesso!');
                break;
        }
    } 

    /**
     * Metodo responsavel por retorna o formulario de edição de um depoimento
     * @param Request $request
     * @param integer $id
     * @return string
     */
    public static function getEditTestimony($request, $id){
        //OBTEN O DEPOIMENTO DO BANCO DE DADOS
        $obTestimony = EntityTestimony::getTestimonyById($id);

        //VAZIO
        if (!$obTestimony instanceof EntityTestimony) {
            $request->getRouter()->redirect('/admin/testimonies');
        }

        //CONTEUDO DO FORMULARIO
        $content = View::render('admin/modules/testimonies/form', [
            'tittle'   => 'Editar Depoimento',
            'nome'     => $obTestimony->nome,
            'mensagem' => $obTestimony->mensagem,
            'status'   => self::getStatus($request)
        ]);

        //RETORNA A PAGINA COMPELTA
        return parent::getPanel('Editar Depoimento > Admin', $content, 'testimonies');
        
    }

    /**
     * Metodo responsavel por gravar a atualizaçao de um depoimento
     * @param Request $request
     * @return string
     */
    public static function setEditTestimony($request, $id){
        //OBTEN O DEPOIMENTO DO BANCO DE DADOS
        $obTestimony = EntityTestimony::getTestimonyById($id);

        //VAZIO
        if (!$obTestimony instanceof EntityTestimony) {
            $request->getRouter()->redirect('/admin/testimonies');
        }
        
        //POST VARS
        $postVars = $request->getPostVars();

        //ATUALIZA A INSTANCIA
        $obTestimony->nome = $postVars['nome'] ?? $obTestimony->nome;
        $obTestimony->mensagem = $postVars['mensagem'] ?? $obTestimony->mensagem;
        $obTestimony->atualizar();
        
        //REDIRECIONA O USUARIO
        $request->getRouter()->redirect('/admin/testimonies/'.$obTestimony->id.'/edit?status=updated');
    }

        /**
     * Metodo responsavel por retorna o formulario de exclusão de um depoimento
     * @param Request $request
     * @param integer $id
     * @return string
     */
    public static function getDeleteTestimony($request, $id){
        //OBTEN O DEPOIMENTO DO BANCO DE DADOS
        $obTestimony = EntityTestimony::getTestimonyById($id);

        //VAZIO
        if (!$obTestimony instanceof EntityTestimony) {
            $request->getRouter()->redirect('/admin/testimonies');
        }

        //CONTEUDO DO FORMULARIO
        $content = View::render('admin/modules/testimonies/delete', [
            'nome'     => $obTestimony->nome,
            'mensagem' => $obTestimony->mensagem
        ]);

        //RETORNA A PAGINA COMPELTA
        return parent::getPanel('Excluir Depoimento > Admin', $content, 'testimonies');
        
    }

    /**
     * Metodo responsavel por excluir um depoimento
     * @param Request $request
     * @return string
     */
    public static function setDeleteTestimony($request, $id){
        //OBTEN O DEPOIMENTO DO BANCO DE DADOS
        $obTestimony = EntityTestimony::getTestimonyById($id);

        //VAZIO
        if (!$obTestimony instanceof EntityTestimony) {
            $request->getRouter()->redirect('/admin/testimonies');
        }
        
        //EXCLUI A INSTANCIA
        $obTestimony->excluir();
        
        //REDIRECIONA O USUARIO
        $request->getRouter()->redirect('/admin/testimonies?status=deleted');
    }

}

