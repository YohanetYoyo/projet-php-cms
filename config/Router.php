<?php
class Router {
    private array $routes;

    public function add($pageName, $controller): void {
        $this->routes[$pageName] = $controller;
    }

    public function patch(): void {
        $page = $_GET['page'] ?? 'home';

        if (!isset($this->routes[$page])) {
            echo "Erreur 404 - Page non trouvée";
            return;
        }

        list($controller, $method) = explode('/', $this->routes[$page]);

        require_once __DIR__.'/../app/controllers/'.$controller.'.php';

        $controller = new $controller();
        $controller->$method();
    }

}