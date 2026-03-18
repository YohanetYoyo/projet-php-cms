<?php
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../repositories/UserRepository.php';

class LoginController {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function show(): void {
        require __DIR__ . '/../views/login.php';
    }

    public function login(): void {
        $errors = [];

        if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            count($_POST) == 2 &&
            !empty($_POST["email"])&&
            !empty($_POST["pwd"])
        ){
            $email = strtolower(trim($_POST["email"]));

            if(!filter_var( $email, FILTER_VALIDATE_EMAIL )) {
                $errors[] = "Format de l'email invalide !";
                require __DIR__ . '/../views/login.php';
                return;
            }

            $emailCheck = $this->userRepository->checkEmail($email);
            $pwdCheck = $this->userRepository->checkPassword($email);

            if (!$emailCheck || !password_verify($_POST["pwd"], $pwdCheck)) {
                $errors[] = "Identifiants incorrects !";
                require __DIR__ . '/../views/login.php';
            } else {
                $user = $this->userRepository->getUserByEmail($email);
                $_SESSION['user'] = new User(array(
                        "idUser" => $user["id_user"],
                        "lastname" => $user["lastname"],
                        "firstname" => $user["firstname"],
                        "email" => $user["email"],
                        "createdAt" => $user["created_at"]
                    )
                );
                header("Location: ?page=home");
                exit;
            }
        }
    }
}
