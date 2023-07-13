<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Testimony{

    /**
     * ID do depoimento
     * @var integer
     */
    public $id;

    /**
     * Nome do usuario que fez o depoimento
     * @var string
     */
    public $nome;

    /**
     * Mensagem do depoimento
     * @var string
     */
    public $mensagem;

    /**
     * Data de publicaçao do depoimento
     * @var string
     */
    public $data;

    /**
     * Metodo Responsavel por cadastrar a instancia atual no bando de dados
     * @return boolean
     */
    public function cadastrar(){
        //DEFINE A DATA
        $this->data = date('Y-m-d H:i:s');
        
        //INSERE O DEPOIMENTOS NO BANDO DE DADOS
        $this->id = (new Database('depoimento'))->insert([
            'nome'=> $this->nome,
            'mensagem'=> $this->mensagem,
            'data' => $this->data,

        ]);
        return true;
        // echo "<pre>";
        // print_r($this);
        // echo"</pre>";
        // exit;
    }



}