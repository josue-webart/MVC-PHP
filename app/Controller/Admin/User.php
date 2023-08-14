<?php

namespace App\Controller\Admin;

use App\Utils\View;
use \App\Model\Entity\User as EntityUser;
use \WilliamCosta\DatabaseManager\Pagination;

class User extends Page
{

    /**
     * Metodo responsavel por obter a renderizçao dos itens de usuarios para a pagina
     * @param Request $request
     * @param Pagination $obPagination
     * @return String
     */
    private static function getUsersItems($request, &$obPagination)
    {
        //USUARIOS
        $itens = '';

        //QUANTIDADE TOTAL DE REGISTROS
        $quantidadeTotal = EntityUser::getUsers(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        //PAGINA ATUAL
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //INSTANCIA DE PAGINAÇÃO
        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 3);

        //RESULTADOS DA PAGINA
        $results = EntityUser::getUsers(null, 'id DESC', $obPagination->getLimit());

        //REDERIZA O ITEM
        while ($obUser = $results->fetchObject(EntityUser::class)) {

            $itens .= View::render('admin/modules/users/item', [
                'id'       => $obUser->id,
                'nome'     => $obUser->nome,
                'email'    => $obUser->email
            ]);
        }

        //RETORNA OS DEPIMENTOS
        return $itens;
    }

    /**
     * Metodo responsavel por rederizar a view de listagem de usuarios
     * @param Request $request
     * @return string
     */
    public static function getUsers($request)
    {
        //CONTEUDO DA HOME
        $content = View::render('admin/modules/users/index', [
            'itens'      => self::getUsersItems($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination),
            'status'     => self::getStatus($request)
        ]);

        //RETORNA A PAGINA COMPELTA
        return parent::getPanel('Users > English Just for You', $content, 'users');
    }

    /**
     * Metodo responsavel por retorna o formulario de cadastro de um novo usuario
     * @param Request $request
     * @return string
     */
    public static function getNewUser($request)
    {
        //CONTEUDO DO FORMULARIO
        $content = View::render('admin/modules/users/form', [
            'tittle'   => 'Cadastrar Usuario',
            'nome'     => '',
            'email' => '',
            'status'   => self::getStatus($request)
        ]);

        //RETORNA A PAGINA COMPELTA
        return parent::getPanel('Cadastro de Usuario > Admin', $content, 'users');
    }

    /**
     * Metodo responsavel por cadastrar um usuario no Banco
     * @param Request $request
     * @return string
     */
    public static function setNewUser($request)
    {

        //DADOS DO POST
        $postVars = $request->getPostVars();
        $email    = $postVars['email'] ?? '';
        $nome     = $postVars['nome'] ?? '';
        $senha    = $postVars['senha'] ?? '';

        //VALIDA O E-MAL A CADASTRAR
        $obUser   = EntityUser::getUserByEmail($email);
        if ($obUser instanceof EntityUser) {
            //REDIRECIONA O USUARIO
            $request->getRouter()->redirect('/admin/users/new?status=duplicated');
        }

        //NOVA INSTANCIA DE USUARIO
        $obUser        = new EntityUser;
        $obUser->nome  = $nome;
        $obUser->email = $email;
        $obUser->senha = password_hash($senha, PASSWORD_DEFAULT);
        $obUser->cadastrar();

        //REDIRECIONA O USUARIO
        $request->getRouter()->redirect('/admin/users/' . $obUser->id . '/edit?status=created');
    }

    /**
     * Metodo responsavel por retornar a mensagem de status 
     * @param Request $request
     * @return string
     */
    private static function getStatus($request)
    {
        //QUERY PARAMS
        $queryParams = $request->getQueryParams();

        //STATUS
        if (!isset($queryParams['status'])) return '';

        //MESAGENS DE STATUS
        switch ($queryParams['status']) {
            case 'created':
                return Alert::getSuccess('Usuario criado com sucesso!');
                break;
            case 'updated':
                return Alert::getSuccess('Usuario atualizado com sucesso!');
                break;
            case 'deleted':
                return Alert::getSuccess('Usuario excluido com sucesso!');
                break;
            case 'duplicated':
                return Alert::getError('O e-mail digitado já existe');
                break;
        }
    }

    /**
     * Metodo responsavel por retorna o formulario de edição de um usuario
     * @param Request $request
     * @param integer $id
     * @return string
     */
    public static function getEditUser($request, $id)
    {
        //OBTEN O USUARIO DO BANCO DE DADOS
        $obUser = EntityUser::getUserById($id);

        //VAZIO
        if (!$obUser instanceof EntityUser) {
            $request->getRouter()->redirect('/admin/users');
        }

        //CONTEUDO DO FORMULARIO
        $content = View::render('/admin/modules/users/form', [
            'tittle'   => 'Editar Usuario',
            'nome'     => $obUser->nome,
            'email'    => $obUser->email,
            'status'   => self::getStatus($request)
        ]);

        //RETORNA A PAGINA COMPELTA
        return parent::getPanel('Editar Usuario > Admin', $content, 'users');
    }

    /**
     * Metodo responsavel por gravar a atualizaçao de um usuario
     * @param Request $request
     * @return string
     */
    public static function setEditUser($request, $id)
    {
        //OBTEN O USUARIO DO BANCO DE DADOS
        $obUser = EntityUser::getUserById($id);

        //VAZIO
        if (!$obUser instanceof EntityUser) {
            $request->getRouter()->redirect('/admin/users');
        }

        //DADOS DO POST
        $postVars = $request->getPostVars();
        $email    = $postVars['email'] ?? '';
        $nome     = $postVars['nome'] ?? '';
        $senha    = $postVars['senha'] ?? '';

        //VALIDA O E-MAL A CADASTRAR
        $obUserEmail   = EntityUser::getUserByEmail($email);
        if ($obUserEmail instanceof EntityUser && $obUser->id != $id) {
            //REDIRECIONA O USUARIO
            $request->getRouter()->redirect('/admin/users/'.$id.'/edit?status=duplicated');
        }

        //POST VARS
        $postVars = $request->getPostVars();

        //ATUALIZA A INSTANCIA
        $obUser->nome  = $nome ?? $obUser->nome;
        $obUser->email = $email ?? $obUser->email;
        $obUser->senha = password_hash($senha, PASSWORD_DEFAULT);
        $obUser->atualizar();

        //REDIRECIONA O USUARIO
        $request->getRouter()->redirect('/admin/users/' . $obUser->id . '/edit?status=updated');
    }

    /**
     * Metodo responsavel por retorna o formulario de exclusão de um usuario
     * @param Request $request
     * @param integer $id
     * @return string
     */
    public static function getDeleteUser($request, $id)
    {
        //OBTEN O USUARIO DO BANCO DE DADOS
        $obUser = EntityUser::getUserById($id);
        

        //VAZIO
        if (!$obUser instanceof EntityUser) {
            $request->getRouter()->redirect('/admin/users');
        }

        //CONTEUDO DO FORMULARIO
        $content = View::render('admin/modules/users/delete', [
            'nome'     => $obUser->nome,
            'email'    => $obUser->email
        ]);
        

        //RETORNA A PAGINA COMPELTA
        return parent::getPanel('Excluir Usuario > Admin', $content, 'users');
    }

    /**
     * Metodo responsavel por excluir um usuario
     * @param Request $request
     * @return string
     */
    public static function setDeleteUser($request, $id)
    {
        //OBTEN O USUARIO DO BANCO DE DADOS
        $obUser = EntityUser::getUserById($id);

        //VAZIO
        if (!$obUser instanceof EntityUser) {
            $request->getRouter()->redirect('/admin/users');
        }

        //EXCLUI A INSTANCIA
        $obUser->excluir();

        //REDIRECIONA O USUARIO
        $request->getRouter()->redirect('/admin/users?status=deleted');
    }
}
