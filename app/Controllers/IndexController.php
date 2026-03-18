<?php
class IndexController {
    public function index(): void {
        if (!isset($_SESSION['user'])) {
            require __DIR__ . "/../views/login.php";
        } else {
            require __DIR__ . '/../views/home.php';
        }
    }

}