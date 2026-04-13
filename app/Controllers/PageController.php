<?php
require_once __DIR__ . "/../Models/Page.php";
require_once __DIR__ . "/../Models/PageUserRoles.php";
require_once __DIR__ . "/../Repositories/PageRepository.php";
require_once __DIR__ . "/../Repositories/PageUserRolesRepository.php";

class PageController {
    private $pageRepository;
    private $pageUserRolesRepository;

    public function __construct() {
        $this->pageRepository = new PageRepository();
        $this->pageUserRolesRepository = new PageUserRolesRepository();
    }

    // AFFICHER LE FORMULAIRE DE CRÉATION
    public function showCreate(): void {
        $errors = [];
        require __DIR__ . '/../Views/CreatePage.php';
    }

    // CRÉER UNE PAGE
    public function create(): void {
        $errors = [];

        if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            !empty($_POST["title"]) &&
            !empty($_POST["content"]) &&
            !empty($_POST["slug"]) &&
            !empty($_POST["status"])
        ) {
            $title = trim($_POST["title"]);
            $content = trim($_POST["content"]);
            $slug = strtolower(str_replace(' ', '', trim($_POST["slug"])));
            $status = trim($_POST["status"]);
            $author = $_SESSION['user']->getIdUser(); 

            if (strlen($title) < 3) {
                $errors[] = "Le titre doit faire au moins 3 caractères";
            }

            if (strlen($content) < 10) {
                $errors[] = "Le contenu doit faire au moins 10 caractères";
            }

            if (strlen($slug) < 3) {
                $errors[] = "Le slug doit faire au moins 3 caractères";
            }

            if (!in_array($status, ['published', 'draft', 'archived'])) {
                $errors[] = "Le statut est invalide";
            }

            if (count($errors) > 0) {
                require __DIR__ . '/../Views/CreatePage.php';
            } else {
                $id = $this->pageRepository->insert(new Page([
                    "title" => $title,
                    "content" => $content,
                    "slug" => $slug,
                    "status" => $status,
                    "author" => $author,
                    "createdAt" => date("Y-m-d H:i:s")
                ]));

                $this->pageUserRolesRepository->insert(new PageUserRoles([
                    "idUser" => $_SESSION['user']->getIdUser(),
                    "idPage" => $id,
                    "idRole" => 1
                ]));
                header("Location: /index");
                exit;
            }
        }
    }

    // AFFICHER LA PAGE À MODIFIER
    public function showUpdate(): void {
        $page = $this->pageRepository->getById($_POST["id_page"]);
        $role = $this->pageUserRolesRepository->getByUserAndPage($_SESSION['user']->getIdUser(), $_POST["id_page"]);
        $users = $this->pageUserRolesRepository->getOtherUsersOnPage($_SESSION['user']->getIdUser(), $_POST["id_page"]);
        require __DIR__ . '/../Views/ModificationPage.php';
    }

    // MODIFIER UNE PAGE
    public function update(): void {
        if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            !empty($_POST["id_page"]) &&
            !empty($_POST["title"]) &&
            !empty($_POST["content"]) &&
            !empty($_POST["slug"]) &&
            !empty($_POST["status"])
        ) {
            $idPage = (int)$_POST["id_page"];
            $title = trim($_POST["title"]);
            $content = trim($_POST["content"]);
            $slug = strtolower(trim($_POST["slug"]));
            $status = trim($_POST["status"]);
            $author = $_SESSION['user']->getIdUser(); 

            $this->pageRepository->update(new Page([
                "idPage" => $idPage,
                "title" => $title,
                "content" => $content,
                "slug" => $slug,
                "status" => $status,
                "author" => $author
            ]));

            if (!empty($_POST['roles'])) {
                foreach($_POST['roles'] as $idUser => $role) {
                    $this->pageUserRolesRepository->update(new PageUserRoles([
                        "idUser" => $idUser,
                        "idPage" => $idPage,
                        "idRole" => $role
                    ]));
                }
            }

            if (!empty($_POST['delete'])) {
                foreach($_POST['delete'] as $idUser) {
                    $this->pageUserRolesRepository->delete($idUser, $idPage);
                }
            }

            header("Location: /index");
            exit;
        }
    }

    // AFFICHER LA PAGE À SUPPRIMER
    public function showDelete(): void {
        $page = $this->pageRepository->getById($_POST["id_page"]);
        require __DIR__ . '/../Views/DeletePage.php';
    }

    // SUPPRIMER UNE PAGE
    public function delete(): void {
        if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            !empty($_POST["id_page"])
        ) {
            $this->pageUserRolesRepository->delete($_POST["id_page"]);
            $this->pageRepository->delete((int)$_POST["id_page"]);
            header("Location: /index");
            exit;
        }
    }

    // AFFICHER LA PAGE À PUBLIER/DÉPUBLIER
    public function showPublish(): void {
        $page = $this->pageRepository->getById($_POST["id_page"]);
        require __DIR__ . '/../Views/PublishPage.php';
    }

    // PUBLIER/DÉPUBLIER UNE PAGE
    public function publish(): void {
        if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            !empty($_POST["id_page"]) &&
            !empty($_POST["status"])
        ) {
            $page = $this->pageRepository->getById((int)$_POST["id_page"]);
            if ($page) {
                $this->pageRepository->update(new Page([
                    "idPage" => $page['id_page'],
                    "title" => $page['title'],
                    "content" => $page['content'],
                    "slug" => $page['slug'],
                    "status" => $_POST["status"],
                    "author" => $page['author'] 
                ]));
            }
            header("Location: /index");
            exit;
        }
    }

    public function show($slug): void {
        $page = $this->pageRepository->getBySlug($slug);
        if (!$page) {
            echo "Erreur 404 - Page non trouvée";
            return;
        }

        $role = $this->pageUserRolesRepository->getByUserAndPage($_SESSION['user']->getIdUser(), $page['id_page']);
        require __DIR__ . '/../Views/ShowPage.php';
    }
}