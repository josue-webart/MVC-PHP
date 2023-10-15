<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Teacher
{

    /**
     * ID do profesor
     * @var integer
     */
    public $id;

    /**
     * Nome do profesor
     * @var string
     */
    public $nome;

    /**
     * E-mail do profesor
     * @var string
     */
    public $descricao;

    /**
     * Senha do profesor
     * @var string
     */
    public $foto;

    /**
     * Metodo responsavel por retornar Profesores
     *
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $field
     * @return PDOStatement
     */
    public static function getTeachers($where = null, $order = null, $limit = null, $fields = '*')
    {   
        
        return (new Database('profesores'))->select($where, $order, $limit, $fields);
    }

    /**
     * Metodo responsavel por retornar um teacher com base no seu ID
     * @param [type] $id
     * @return Teacher
     */
    public static function getTeacherById($id)
    {
        return self::getTeachers('id = ' . $id)->fetchObject(self::class);
    }

    /**
     * Metodo Responsavel por atualizar a instancia atual no banco de dados
     * @return boolean
     */
    public function atualizar()
    {

        //ATUALIZA O DEPOIMENTOS NO BANCO DE DADOS
        return (new Database('profesores'))->update('id = ' . $this->id, [
            'nome'      => $this->nome,
            'descricao' => $this->descricao,
            'foto'      => $this->foto
        ]);
        //SUCESSO
        return true;
    }

    /**
     * Metodo Responsavel por excluir um teacher no banco de dados
     * @return boolean
     */
    public function excluir()
    {
        //EXCLUI O DEPOIMENTOS NO BANCO DE DADOS
        return (new Database('profesores'))->delete('id = ' . $this->id);

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
        $this->id = (new Database('profesores'))->insert([
            'nome'      => $this->nome,
            'descricao' => $this->descricao,
            'foto'      => $this->foto
        ]);
        //SUCESSO
        return true;
    }
}
