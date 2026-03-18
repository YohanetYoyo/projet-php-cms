<?php
class Router {
    private array $routes;

    public function add($method, $pageName, $controller): void {
        $method = strtoupper($method);
        $this->routes[$method][$pageName] = $controller;
    }

    public function patch(): void {
        $page = $_GET['page'] ?? 'index';
        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$method][$page])) {
            echo "Erreur 404 - Page non trouvée";
            return;
        }

        list($controller, $method) = explode('/', $this->routes[$method][$page]);

        require_once __DIR__.'/../app/controllers/'.$controller.'.php';

        $controller = new $controller();
        $controller->$method();
    }

}