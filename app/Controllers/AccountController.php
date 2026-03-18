<?php
require_once __DIR__ . '/../repositories/UserRepository.php';

class AccountController {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }
    public function show() {
        require __DIR__ . "/../views/account.php";
    }

    public function delete() {
        $this->userRepository->deleteUser($_SESSION['user']->getIdUser());
        session_destroy();
        header("Location: ?page=login");
        exit;
    }
}