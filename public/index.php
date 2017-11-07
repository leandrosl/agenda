<?php

require dirname(__DIR__) . '/vendor/autoload.php';

error_reporting(E_ALL);

$router = new Core\Router();

$router->add('', ['controller' => 'ContatoController', 'action' => 'index']);

$router->dispatch($_SERVER['QUERY_STRING']);