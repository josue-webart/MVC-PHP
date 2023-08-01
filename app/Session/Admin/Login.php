<?php

namespace App\Session\Admin;

class Login{

    /**
     * Metodo responsavel por iniciar a sessão
     */
    private static function init() {
        
        //VERIFICA SE A SESSÃO NÃO ESTA ATVA
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    /**
     * Metodo responsavel por criar o login do usuario
     * @param User $obUser
     * @return boolean
     */
    public static function login($obUser){
        //INICIA A SESSAO
        self::init();

        //DEFINE A SESSAO DO USUARIO
        $_SESSION['admin']['usuario'] = [
            'id'    => $obUser->id,
            'nome'  => $obUser->nome,
            'email' => $obUser->email
        ];
        
        //SUCESSO
        return true;
    }

        
    /**
     * Metodo Responsavel por verificar se o usuario está logado
     * @return boolean
     */
    public static function isLogged(){
        //INICIA A SESSAO
        self::init();

        //RETORNA A VERIFICAÇAO
        return isset($_SESSION['admin']['usuario']['id']);
    }

    /**
     * Metodo responsavel por destruir o login do usuario
     * @return boolean
     */
    public static function logout(){
        //INICIA A SESSÃO
        self::init();

        //DESLOGA O USUARIO
        unset($_SESSION['admin']['usuario']);

        //SUCESSO
        return true;
    }

}