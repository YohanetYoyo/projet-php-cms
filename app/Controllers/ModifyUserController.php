<?php
require_once __DIR__ . "/../Models/User.php";
require_once __DIR__ . "/../Repositories/UserRepository.php";

class ModifyUserController {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function update(): void {
        $errors = [];

        if(
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            count($_POST) == 5 &&
            !empty($_POST["lastname"]) &&
            !empty($_POST["firstname"]) &&
            !empty($_POST["email"]) &&
            isset($_POST["isAdmin"]) &&
            !empty($_POST["idUser"])
        ){
            $lastname = strtoupper(trim($_POST["lastname"]));
            $firstname = ucwords(strtolower(trim($_POST["firstname"])));
            $email = strtolower(trim($_POST["email"]));
            $isAdmin = trim($_POST["isAdmin"]);
            $idUser = trim($_POST["idUser"]);

            if (strlen($lastname) == 1) {
                $errors[] = "Le nom doit faire au moins 2 caractères";
            }

            if (strlen($firstname) == 1) {
                $errors[] = "Le prénom doit faire au moins 2 caractères";
            }

            if (!filter_var( $email, FILTER_VALIDATE_EMAIL )) {
                $errors[] = "Format de l'email invalide !";
            } else {
                $check = $this->userRepository->checkEmail($email);
                if (!empty($check) != $email) {
                    $errors[] = "L'email existe déjà !";
                }
            }

            if(count($errors) > 0) {
                require __DIR__ . '/../views/Admin/modify-user.php';
            } else {
                $this->userRepository->updateUser(new User(array(
                    "lastname" => $lastname,
                    "firstname" => $firstname,
                    "email" => $email,
                    "isAdmin" => $isAdmin,
                    "idUser" => $idUser
                )));
                header("Location: /manage-users");
                exit;
            }
        }
    }
}