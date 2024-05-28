<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes);


$routes->group('vagas', function ($routes) {
    // vagas
    $routes->get('detalhes/(:num)', 'vagas\VagasController::detalhes/$1', ['as' => 'vaga.detalhes']);
    $routes->post('candidatar/(:num)', 'vagas\VagasController::candidatar/$1', ['as' => 'vaga.candidatar']);
    // Procurar Vagas
    $routes->match(['get', 'post'], 'procurar-vagas', 'vagas\VagasController::procurarVagas', ['as' => 'procurar.vagas']);
});

$routes->group('usuario', function ($routes) {
    // trabalhador
    $routes->get('perfil', 'usuarios\UserController::perfil', ['as' => 'usuario.perfil']);
    $routes->get('atualiza-perfil', 'usuarios\UserController::atualizaPerfil', ['as' => 'atualizar.usuario.perfil']);
    $routes->post('atualiza-perfil', 'usuarios\UserController::submitAtualizaPerfil', ['as' => 'submit.atualizar.usuario.perfil']);
});


// Panel Admin
$routes->get('admin/login', 'Admin\AdminController::login', ['as' => 'admin.login', 'filter' => 'loginfilter']);
$routes->match(['get', 'post'], 'admin/registrar', 'Admin\AdminController::registrarUsuario', ['as' => 'admin.registrar.usuario']);
$routes->post('admin/login', 'Admin\AdminController::checkLogin', ['as' => 'admin.check.login']);

$routes->match(['get', 'post'], 'admin/verificar', 'Admin\AdminController::verificar', ['as' => 'admin.check.code']);
$routes->match(['get', 'post'], 'admin/recuperar-senha', 'Admin\AdminController::recuperarSenha', ['as' => 'admin.recupera.senha']);

$routes->group('admin', ['filter' => 'authfilter'], function ($routes) {
    // usuario adminstrativos
    $routes->get('/', 'Admin\AdminController::index', ['as' => 'admin.index']);
    $routes->get('logout', 'Admin\AdminController::logout', ['as' => 'admin.logout']);
});