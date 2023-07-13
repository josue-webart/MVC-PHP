<?php

require __DIR__.'/../vendor/autoload.php';

use App\Utils\View;
use \WilliamCosta\DotEnv\Environment;
use \WilliamCosta\DatabaseManager\Database;

//CARREGA VARIAVEIS DE AMBIENTE
Environment::load(__DIR__.'/../');

//DEFINE AS CONFIGURAÇOES DE BANC DE DADOS
Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT')
);

//DEFINE A CONSTANTE DE UR DO PROJETO
define('URL', getenv('URL'));

//DEFINE VALOR PADRAO DAS VARIAVEIS
View::init([
    'URL' => URL
]);

// //debuge
// echo "<pre>";
// print_r(getenv('URL'));
// echo "</pre>";
// exit;