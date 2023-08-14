<?php

namespace App\Controller\Admin;

use App\Model\Entity\User;
use App\Utils\View;
use App\Session\Admin\Login as SessionAdminLogin;


class Login extends Page{    

    /**
     * Metodo responsavel por retornar a renderização da pagina de login
     * @param Request $request
     * @param string $errorMessage
     * @return string
     */
    public static function getLogin($request, $errorMessage = null){

        //STATUS
        $status = !is_null($errorMessage) ? Alert::getError($errorMessage) : '';

        //CONTEUDO DA PAGINA DE LOGIN
        $content = View::render('admin/login',[
            'status' => $status
        ]);

        //RETORNA A PAGINA COMPLETA
        return parent::getPage('Login > Englis Just For You', $content);
    }

    /**
     * Metodo responsavel por definir o login do usuario
     * @param Request $request
     * @return string
     */
    public static function setLogin($request){
        //POST VARS
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $senha = $postVars['senha'] ?? '';

        //BUSCA O USUARIO PELO E-MAIL
        $obUser = User::getUserByEmail($email);
        if (!$obUser instanceof User) {
            return self::getLogin($request, 'E-mail ou senha invalidos');
        }
        
        //VERIFICA A SENHA DO USUARIO
        if (!password_verify($senha, $obUser->senha)){
            return self::getLogin($request, 'Senha invalida');
        }

        //CRIA A SESSÃO DE LOGIN
        SessionAdminLogin::login($obUser);

        //REDIRECIONA O USUARIO PARA A HOME DO ADMIN
        $request->getRouter()->redirect('/admin');
    }

    /**
     * Metodo responsavel por deslogartr o usuário
     * @param Request $request
     */
    public static function setLogout($request){
        //DESTROI A SESSÃO DE LOGIN
        SessionAdminLogin::logout();

        //REDIRECIONA O USUARIO PARA A TELA DE LOGIN
        $request->getRouter()->redirect('/admin/login');
        
    }
    
}

