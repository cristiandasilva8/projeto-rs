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
