<?php

require __DIR__.'/vendor/autoload.php';

use \App\Http\Router;
use App\Utils\View;

use function Composer\Autoload\includeFile;

define('URL', 'http://127.0.0.1:8080');

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
