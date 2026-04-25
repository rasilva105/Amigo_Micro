<?php
use Slim\Factory\AppFactory;
 
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/config/database.php';
 
$endpointsAmigos = require __DIR__ . '/../app/Amigos/Presentation/Routers/endpoints.php';
 
$app = AppFactory::create();
 
$endpointsAmigos($app);
 
$app->run();
 