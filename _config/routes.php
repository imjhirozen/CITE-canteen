<?php

$router->get('/', 'Controller/home/index.php');
$router->post('/', 'Controller/home/store.php');

$router->get('/admin', 'Controller/admin/index.php');
$router->post('/admin', 'Controller/admin/create.php');
$router->get('/admin/edit', 'Controller/admin/detail.php');
$router->post('/admin/edit', 'Controller/admin/update.php');
$router->delete('/admin', 'Controller/admin/destroy.php');

$router->get('/login', 'Controller/session/index.php');
$router->post('/login', 'Controller/session/create.php');
$router->get('/destroy', 'Controller/session/destroy.php');

$router->get('/registration', 'Controller/registration/index.php');
$router->post('/registration', 'Controller/registration/create.php');