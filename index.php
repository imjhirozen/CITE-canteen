<?php

session_start();

require 'Core/function.php';
require 'Core/Middleware.php';
require 'Core/Router.php';
require 'Model/Database.php';

$router = new Router();
require '_config/routes.php';
$path = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route( $path, $method );

