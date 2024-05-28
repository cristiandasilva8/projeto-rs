<?php

$routes->group('api', ['namespace' => 'App\Controllers\Api'], static function ($routes) {

    $routes->group('v1',[], static function ($routes){
        $routes->get('/', 'VagasApiController::index', ['as' => 'api']);
        $routes->resource('vagas', ['controller' => '\App\Controllers\Api\VagasApiController', 'only' => ['index', 'show']]);
    });
        
});
