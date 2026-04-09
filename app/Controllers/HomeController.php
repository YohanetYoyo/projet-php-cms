<?php
require_once __DIR__ . "/../Repositories/PageRepository.php";

class HomeController {
    private $pageRepository;

    public function __construct() {
        $this->pageRepository = new PageRepository();
    }

    public function show(): void {
        $pages = [];
        if (isset($_SESSION['user'])) {
            $author = $_SESSION['user']->getIdUser();
            $pages = $this->pageRepository->getByAuthor($author);
        }
        require __DIR__ . '/../Views/home.php';
    }

    public function logout(): void {
        session_destroy();
        header("Location: /login");
        exit;
    }
}