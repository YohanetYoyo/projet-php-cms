<?php
require_once __DIR__ . "/../Repositories/PageRepository.php";
class IndexController {
     private $pageRepository;

    public function __construct() {
        $this->pageRepository = new PageRepository();
    }
    public function index(): void {
        if (!isset($_SESSION['user'])) {
            require __DIR__ . "/../views/login.php";
        } else {
           $pages = [];
        if (isset($_SESSION['user'])) {
            $author = $_SESSION['user']->getIdUser();
            $pages = $this->pageRepository->getByAuthor($author);
        }
        require __DIR__ . '/../Views/home.php';
        }
    }

}