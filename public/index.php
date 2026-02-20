<?php
require_once __DIR__ . '/../config/Router.php';

$router = new Router();

$router->add('home', 'HomeController/index');
$router->patch();