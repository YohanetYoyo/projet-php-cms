<?php
class Router {
    private array $routes;

    // Ajouter une route (la méthode GET ou POST, le nom de la page et le controller)
    public function add($method, $pageName, $controller): void {
        // La méthode en majuscules
        $method = strtoupper($method);
        // Dans la liste des routes, on associe le controller à la méthode et la page
        $this->routes[$method][$pageName] = $controller;
    }

    // On répartie les routes
    public function patch(): void {
        // On nettoie le paramètre page écrit en URL après le localhost/
        // S'il n'y en a pas, on va sur index par défaut
        $page = trim($_GET['page'] ?? 'index', '/');
        // Récupère la méthode (GET ou POST)
        $method = $_SERVER['REQUEST_METHOD'];

        // S'il y a une route trouvée
        if (isset($this->routes[$method][$page])) {
            // On sépare le controller et l'action en deux parties via le '/'
            list($controller, $action) = explode('/', $this->routes[$method][$page]);

            // On appelle le fichier contenant le controller
            require_once __DIR__.'/../app/controllers/'.$controller.'.php';

            $controller = new $controller();
            // On exécute la fonction qui possède le même nom que l'action
            $controller->$action();
            return;
        }

        // Sinon, on essaye le pattern qui recherche le slug d'une page
        $slug = explode('/', $page);
        if ($slug[0] === 'page' && count($slug) == 2) {
            require_once __DIR__.'/../app/controllers/PageController.php';
            $controller = new PageController();
            $controller->show($slug[1]);
            return;
        }

        // Si rien ne marche, on affiche une erreur
        echo "Erreur 404 - Page non trouvée";
    }

}