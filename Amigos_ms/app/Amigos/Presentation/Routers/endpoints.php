<?php
 
use Slim\App;
use App\Amigos\Presentation\Repositories\TestRepository;
use App\Amigos\Presentation\Repositories\AmigosRepository;
use Slim\Routing\RouteCollectorProxy;
 
return function (App $app) {
    $app->get('/test', [TestRepository::class, 'hola']);
 
    $app->post('/amigo', [AmigosRepository::class, 'create']);
    $app->get('/amigos', [AmigosRepository::class, 'all']);
    $app->get('/amigo/{id}', [AmigosRepository::class, 'detail']);
    $app->put('/amigo/{id}', [AmigosRepository::class, 'update']);
    $app->delete('/amigo/{id}', [AmigosRepository::class, 'delete']);
 
    $app->group('/amigos-v2', function (RouteCollectorProxy $group) {
        $group->get('', [AmigosRepository::class, 'all']);
        $group->get('/{id}', [AmigosRepository::class, 'detail']);
        $group->post('', [AmigosRepository::class, 'create']);
        $group->put('/{id}', [AmigosRepository::class, 'update']);
        $group->delete('/{id}', [AmigosRepository::class, 'delete']);
    });
};
 