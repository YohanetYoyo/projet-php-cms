<?php
require_once __DIR__ . '/../config/Router.php';
require_once __DIR__ . "/../app/Models/User.php";
session_start();

$router = new Router();

$router->add('GET','index', 'IndexController/index');

$router->add('GET','login', 'LoginController/show');
$router->add('POST','login', 'LoginController/login');

$router->add('GET','forgot-password', 'ForgotPasswordController/show');
$router->add('POST','forgot-password', 'ForgotPasswordController/request');

$router->add('GET','reset-password', 'ForgotPasswordController/showReset');
$router->add('POST','reset-password', 'ForgotPasswordController/reset');

$router->add('GET','register', 'RegisterController/show');
$router->add('POST','register', 'RegisterController/register');

$router->add('POST','home', 'HomeController/logout');
$router->add('GET','home', 'HomeController/show');

$router->add('GET','account', 'AccountController/show');
$router->add('POST','account/update', 'AccountController/update');
$router->add('POST','account/delete', 'AccountController/delete');

$router->add('GET','manage-users', 'ManageUsersController/show');
$router->add('POST','manage-users/update', 'ManageUsersController/update');
$router->add('POST','manage-users/delete', 'ManageUsersController/delete');

$router->add('GET','create-user', 'CreateUserController/show');
$router->add('POST','create-user', 'CreateUserController/create');

$router->add('POST','modify-user', 'ModifyUserController/update');

$router->add('GET','create-page', 'PageController/showCreate');
$router->add('POST','create-page', 'PageController/create');

$router->add('GET','delete-page', 'PageController/showDelete');
$router->add('POST','delete-page', 'PageController/delete');

$router->add('GET','modify-page', 'PageController/showUpdate');
$router->add('POST','modify-page', 'PageController/update');

$router->add('GET','publish-page', 'PageController/showPublish');
$router->add('POST','publish-page', 'PageController/publish');

$router->patch();