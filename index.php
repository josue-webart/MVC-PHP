<?php

require __DIR__.'/vendor/autoload.php';

use \App\Http\Router;
use \App\Http\Response;
use \App\Controller\Pages\Home;

define('URL', 'http://localhost/englishjfy');

$obRouter = new Router(URL);
//ROTA HOME
$obRouter->get('/',[
    function(){
        return new Response(200,Home::getHome());
    }
]);


//IMPRIME O RESPONSE DA ROTA
$obRouter->run()->sendResponse();


// echo "<pre>";
// print_r($obRouter);
// echo "</pre>";


// exit;

// echo Home::getHome();