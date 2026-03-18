<?php
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../repositories/UserRepository.php';

class ManageUsersController {

    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }
    public function show(): void {
        $users = $this->userRepository->getUsers();
        require __DIR__ . '/../views/Admin/manage-users.php';
    }

    public function update(): void {
        $user = $this->userRepository->getUserById($_POST["idUser"]);
        require __DIR__ . '/../views/Admin/modify-user.php';
    }
}