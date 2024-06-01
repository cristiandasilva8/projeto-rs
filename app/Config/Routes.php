<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['as' => 'home.index']);


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

$routes->group('imoveis', function ($routes) {
    // Imoveis
    $routes->get('/', 'Home::imoveis', ['as' => 'imoveis.index']);
    $routes->get('detalhes/(:num)', 'imoveis\ImoveisController::detalhes/$1', ['as' => 'imovel.detalhes']);
    $routes->post('listar', 'imoveis\ImoveisController::listarImoveis', ['as' => 'imovel.listar']);
    $routes->get('procurar', 'imoveis\ImoveisController::procurar', ['as' => 'imovel.procurar']);

    // Procurar Imoveis
    $routes->match(['get', 'post'], 'procurar-imoveis', 'imoveis\ImoveisController::procurarImoveis', ['as' => 'procurar.imoveis']);
});

$routes->group('usuario', function ($routes) {
    // trabalhador
    $routes->get('perfil', 'usuarios\UserController::perfil', ['as' => 'usuario.perfil']);
    $routes->get('familiares', 'usuarios\UserController::familiares', ['as' => 'usuario.familiares']);
    $routes->post('adicionar_informacao/(:segment)', 'usuarios\UserController::adicionarInformacao/$1');
    $routes->post('salvar_informacoes_pessoais', 'usuarios\UserController::salvarInformacoesPessoais');
    $routes->post('salvar_objetivo_profissional', 'usuarios\UserController::salvarObjetivoProfissional');

    $routes->post('excluir_informacao/(:any)/(:num)', 'usuarios\UserController::excluirInformacao/$1/$2');

    
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
    $routes->match(['get', 'post'], 'imovel/add', 'Admin\AdminImoveisController::cadastrarImovel', ['as' => 'admin.imovel.add']);
    $routes->match(['get', 'post'], 'imovel/edit/(:num)', 'Admin\AdminImoveisController::editarImovel/$1', ['as' => 'admin.imovel.edit']);    
    $routes->match(['get', 'post'], 'imovel/uploadImages/(:num)', 'Admin\AdminImoveisController::uploadImages/$1', ['as' => 'admin.imovel.uploadImages']);
    $routes->delete('imovel/deleteImage/(:num)', 'Admin\AdminImoveisController::deleteImage/$1', ['as' => 'admin.imovel.deleteImage']);
    $routes->delete('imovel/delete/(:num)', 'Admin\AdminImoveisController::excluirImovel/$1', ['as' => 'admin.imovel.delete']);
    $routes->get('imovel/listar', 'Admin\AdminImoveisController::listarImoveis', ['as' => 'admin.imovel.listar']);

});