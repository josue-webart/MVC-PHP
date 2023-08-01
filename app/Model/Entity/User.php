<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class User{

    /**
     * ID do usuario
     * @var integer
     */
    public $id;

    /**
     * Nome do usuario
     * @var string
     */
    public $nome;

    /**
     * E-mail do Usuario
     * @var string
     */
    public $email;

    /**
     * Senha do Usuario
     * @var string
     */
    public $senha;

    /**
     * Metodo responsavel pro retornar um usuario com base em seu e-mail
     *
     * @param string $email
     * @return User
     */
    public static function getUserByEmail($email){
        return (new Database('usuarios'))->select('email = "'.$email.'"')->fetchObject(self::class);
    }


}