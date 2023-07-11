<?php

namespace App\Http;

class Request {
    
    /**
     * Metodo HTTP da requisição
     * @var string 
     */
    private $httpMethod;
    /**
     * URI da página
     * @var string
     */
    private $uri;

    /**
     * Parametro da URL ($_GET)
     * @var array
     */
    private $queryParams =[];
    /**
     * Variaveis recibidas no PSOT da pagina ($_POST)
     * @var array
     */
    private $postVars = [];
    /**
     * Cabeçalho de requisição
     * @var array
     */
    private $headers = [];

    public function __construct(){
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }

    /**
     * Metodo responsavel por retornar o metodo HTTP da requisição
     * @return string
     */
    public function getHttpMethod(){
        return $this->httpMethod;
    }
    
    /**
     * Metodo responsavel por retornar a URI da requisição
     * @return string
     */
    public function getUri(){
        return $this->uri;
    }

    /**
     * Metodo responsavel por retornar os headers da requisição
     * @return array
     */
    public function getHeaders(){
        return $this->headers;
    }

    /**
     * Metodo responsavel por retornar os parametros da URL da requisição
     * @return array
     */
    public function getQueryParams(){
        return $this->queryParams;
    }
    
    /**
     * Metodo responsavel por retornar as variaveis POST da requisição
     * @return array
     */
    public function getPostVars(){
        return $this->postVars;
    }
}