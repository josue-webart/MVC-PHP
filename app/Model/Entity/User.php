<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class User
{

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
    public static function getUserByEmail($email)
    {
        return self::getUsers('email = "' . $email . '"')->fetchObject(self::class);
    }

    /**
     * Metodo responsavel por retornar Usuarios
     *
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $field
     * @return PDOStatement
     */
    public static function getUsers($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('usuarios'))->select($where, $order, $limit, $fields);
    }

    /**
     * Metodo responsavel por retornar um usuario com base no seu ID
     * @param [type] $id
     * @return Testimony
     */
    public static function getUserById($id)
    {
        return self::getUsers('id = ' . $id)->fetchObject(self::class);
    }

    /**
     * Metodo Responsavel por atualizar a instancia atual no banco de dados
     * @return boolean
     */
    public function atualizar()
    {

        //ATUALIZA O DEPOIMENTOS NO BANCO DE DADOS
        return (new Database('usuarios'))->update('id = ' . $this->id, [
            'nome'  => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ]);
        //SUCESSO
        return true;
    }

    /**
     * Metodo Responsavel por excluir um usuario no banco de dados
     * @return boolean
     */
    public function excluir()
    {
        //EXCLUI O DEPOIMENTOS NO BANCO DE DADOS
        return (new Database('usuarios'))->delete('id = ' . $this->id);

        //SUCESSO
        return true;
    }

    /**
     * Metodo Responsavel por cadastrar a instancia atual no banco de dados
     * @return boolean
     */
    public function cadastrar()
    {
        //INSERE O USUARIO NO BANCO DE DADOS
        $this->id = (new Database('usuarios'))->insert([
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ]);
        //SUCESSO
        return true;
    }
}
