<?php


require __DIR__.'/vendor/autoload.php';

use \App\Http\Router;
use App\Utils\View;
use \WilliamCosta\DotEnv\Environment;

//CARREGA VARIAVEIS DE AMBIENTE
Environment::load(__DIR__);

//DEFINE A CONSTANTE DE UR DO PROJETO
define('URL', getenv('URL'));

//DEFINE VALOR PADRAO DAS VARIAVEIS
View::init([
    'URL' => URL
]);

$obRouter = new Router(URL);

//INCLUI AS ROTAS DA PAGINA
include __DIR__.'/routes/pages.php';


//IMPRIME O RESPONSE DA ROTA
$obRouter->run()->sendResponse();



//debuge
// echo "<pre>";
// print_r($obRouter);
// echo "</pre>";
// exit;
