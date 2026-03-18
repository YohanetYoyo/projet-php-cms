<?php
require_once __DIR__ . "/../Models/User.php";
require_once __DIR__ . "/../Repositories/UserRepository.php";

class CreateUserController {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function show(): void {
        require __DIR__ . '/../views/Admin/create-user.php';
    }

    public function create(): void {
        $errors = [];

        if(
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            count($_POST) == 6 &&
            !empty($_POST["lastname"]) &&
            !empty($_POST["firstname"]) &&
            !empty($_POST["email"]) &&
            !empty($_POST["pwd"]) &&
            !empty($_POST["confirmPwd"]) &&
            isset($_POST["isAdmin"])
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
                $check = $this->userRepository->checkEmail($email);
                if ($check) {
                    $errors[] = "L'email existe déjà !";
                }
            }

            if(
                strlen($_POST["pwd"]) < 8 ||
                !preg_match("#[a-z]#", $_POST["pwd"]) ||
                !preg_match("#[A-Z]#", $_POST["pwd"]) ||
                !preg_match("#[0-9]#", $_POST["pwd"]) ||
                !preg_match("#[-.;?,!]#", $_POST["pwd"])
            ){
                $errors[] = "Votre mot de passe est incorrect. Il doit posséder 8 caractères dont 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial (.;?,-!)";
            } else if ($_POST["pwd"] != $_POST["confirmPwd"]) {
                $errors[] = "Les mots de passe ne correspondent pas !";
            }
            if(count($errors) > 0) {
                require __DIR__ . '/../views/Admin/create-user.php';
            } else {
                $check = $this->userRepository->insertUser(new User(array(
                    "lastname" => $lastname,
                    "firstname" => $firstname,
                    "email" => $email,
                    "pwd" => password_hash($_POST["pwd"], PASSWORD_DEFAULT),
                    "isAdmin" => $_POST['isAdmin'],
                    "createdAt" => date("Y-m-d H:i:s")
                )));
                if ($check) {
                    header("Location: ?page=manage-users");
                    exit;
                }
            }
        }
    }
}