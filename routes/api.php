<?php

$routes->group('api', [], static function ($routes) {

    $routes->group('v1',['namespace' => 'App\Controllers\Api', 'filter'=> 'basicAuthFilter'], static function ($routes){
        $routes->get('/', 'VagasApiController::index', ['as' => 'api']);
        $routes->resource('vagas', ['controller' => '\App\Controllers\Api\VagasApiController', 'only' => ['index', 'show']]);
        $routes->resource('imoveis', ['controller' => '\App\Controllers\Api\ImoviesApiController', 'only' => ['index', 'show']]);
        $routes->resource('candidatos', ['controller' => '\App\Controllers\Api\CandidatosApiController', 'only' => ['index', 'show']]);
        $routes->resource('inscricao', ['controller' => '\App\Controllers\Api\InscricaoApiController', 'only' => ['index', 'show', 'create']]);
    });
        
});
