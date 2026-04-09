<?php
class HomeController {
    public function show(): void {
        require __DIR__ . '/../Views/home.php';
    }

    public function logout(): void {
        session_destroy();
        header("Location: /login");
        exit;
    }
}