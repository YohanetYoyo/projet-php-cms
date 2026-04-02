<?php
class HomeController {
    public function logout(): void {
        session_destroy();
        header("Location: /login");
        exit;
    }
}