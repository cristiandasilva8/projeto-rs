<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/user-image/(:any)', 'ImageController::getUserImage/$1');

service('auth')->routes($routes);

$routes->group('vagas', function ($routes) {
    // vagas
    $routes->get('detalhes/(:num)', 'vagas\VagasController::detalhes/$1', ['as' => 'vaga.detalhes']);
    $routes->post('candidatar/(:num)', 'vagas\VagasController::candidatar/$1', ['as' => 'vaga.candidatar']);
    $routes->post('listar', 'vagas\VagasController::listarVagas', ['as' => 'vaga.listar']);
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
    $routes->match(['get', 'post'], 'usuario/perfil', 'Admin\AdminController::perfil', ['as' => 'admin.usuario.perfil']);
    
    // Categorias
    $routes->match(['get', 'post'], 'categorias/add', 'Admin\AdminController::cadastrarCategoria', ['as' => 'admin.vaga.categoria.add']);
    $routes->match(['get', 'post'], 'categorias/edit', 'Admin\AdminController::editarCategoria', ['as' => 'admin.vaga.categoria.edit']);
    $routes->match(['get', 'delete'], 'categorias/delete', 'Admin\AdminController::excluirCategoria', ['as' => 'admin.vaga.categoria.delete']);

    // vagas de emprego
    $routes->match(['get', 'post'], 'vagas/add', 'Admin\AdminVagasController::cadastrarVaga', ['as' => 'admin.vaga.add']);
    $routes->match(['get', 'post'], 'vagas/edit/(:num)', 'Admin\AdminVagasController::editarVaga/$1', ['as' => 'admin.vaga.edit']);
    $routes->delete('vagas/delete/(:num)', 'Admin\AdminVagasController::excluirVaga/$1', ['as' => 'admin.vaga.delete']);
    $routes->get('vagas/listar', 'Admin\AdminVagasController::listarVagas', ['as' => 'admin.vaga.listar']);
    $routes->get('vagas/candidatos/(:num)', 'Admin\AdminVagasController::candidatos/$1', ['as' => 'vagas.candidatos']);

    // Imobiliaria imóveis
    $routes->get('imovel/listar', 'Admin\AdminImoveisController::listarImovel', ['as' => 'admin.imovel.listar']);
    $routes->match(['get', 'post'], 'imovel/add', 'Admin\AdminImoveisController::cadastrarImovel', ['as' => 'admin.imovel.add']);
    $routes->match(['get', 'post'], 'imovel/edit/(:num)', 'Admin\AdminImoveisController::editarImovel/$1', ['as' => 'admin.imovel.edit']);    
    $routes->match(['get', 'post'], 'imovel/uploadImages/(:num)', 'Admin\AdminImoveisController::uploadImages/$1', ['as' => 'admin.imovel.uploadImages']);



});