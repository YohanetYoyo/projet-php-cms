<?php
require_once __DIR__ . '/../config/Router.php';
require_once __DIR__ . "/../app/Models/User.php";
session_start();

$router = new Router();

$router->add('GET','index', 'IndexController/index');

$router->add('GET','login', 'LoginController/show');
$router->add('POST','login', 'LoginController/login');

$router->add('GET','register', 'RegisterController/show');
$router->add('POST','register', 'RegisterController/register');

$router->add('POST','home', 'HomeController/logout');

$router->patch();