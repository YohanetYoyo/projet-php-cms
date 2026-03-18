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

    public function update() {
        $errors = [];

        if(
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            count($_POST) == 3 &&
            !empty($_POST["lastname"]) &&
            !empty($_POST["firstname"]) &&
            !empty($_POST["email"])
        ){
            $lastname = strtoupper(trim($_POST["lastname"]));
            $firstname = ucwords(strtolower(trim($_POST["firstname"])));
            $email = strtolower(trim($_POST["email"]));

            if (strlen($lastname) == 1) {
                $errors[] = "Votre nom doit faire au moins 2 caractères";
            }

            if (strlen($firstname) == 1) {
                $errors[] = "Votre prénom doit faire au moins 2 caractères";
            }

            if (!filter_var( $email, FILTER_VALIDATE_EMAIL )) {
                $errors[] = "Format de l'email invalide !";
            } else {
                if ($_SESSION['user']->getEmail() != $email) {
                    $check = $this->userRepository->checkEmail($email);
                    if ($email == $check) {
                        $errors[] = "L'email existe déjà !";
                    }
                }
            }

            if(count($errors) > 0) {
                require __DIR__ . '/../views/account.php';
            } else {
                $this->userRepository->updateUser(new User(array(
                    "lastname" => $lastname,
                    "firstname" => $firstname,
                    "email" => $email,
                    "idUser" => $_SESSION['user']->getIdUser()
                )));
                $user = $this->userRepository->getUserByEmail($email);
                $_SESSION['user'] = new User(array(
                    "idUser" => $user['id_user'],
                    "lastname" => $user['lastname'],
                    "firstname" => $user['firstname'],
                    "email" => $user['email'],
                    "isAdmin" => $user["is_admin"],
                    "createdAt" => $user["created_at"]
                ));
                header("Location: ?page=index");
                exit;
            }
        }
    }

    public function delete() {
        $this->userRepository->deleteUser($_SESSION['user']->getIdUser());
        session_destroy();
        header("Location: ?page=login");
        exit;
    }
}