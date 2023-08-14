<?php

use \App\Http\Response;
use \App\Controller\Admin;

//ROTA DE LISTAGEM DE USUARUOS
$obRouter->get('/admin/users',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request){
        return new Response(200, Admin\User::getUsers($request));
    }
]);

//ROTA DE CADASTRO DE UM NOVO USUARIO
$obRouter->get('/admin/users/new',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request){
        return new Response(200, Admin\User::getNewUser($request));
    }
]);

//ROTA USUARIOS (POST)
$obRouter->post('/admin/users/new',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request){
        return new Response(200,Admin\User::setNewUser($request));
    }
]);

//ROTA DE EDIÇAO DE UM USUARIOS
$obRouter->get('/admin/users/{id}/edit',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request, $id){
        return new Response(200, Admin\User::getEditUser($request, $id));
    }
]);

//ROTA DE EDIÇAO DE UM USUARIO (POST)
$obRouter->post('/admin/users/{id}/edit',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request, $id){
        return new Response(200, Admin\User::setEditUser($request, $id));
    }
]);

//ROTA DE EXCLUSÃO DE UM USUARIO
$obRouter->get('/admin/users/{id}/delete',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request, $id){
        return new Response(200, Admin\User::getDeleteUser($request, $id));
    }
]);


//ROTA DE EXCLUSÃO DE UM USUARIO (POST)
$obRouter->post('/admin/users/{id}/delete',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request, $id){
        return new Response(200, Admin\User::setDeleteUser($request, $id));
    }
]);