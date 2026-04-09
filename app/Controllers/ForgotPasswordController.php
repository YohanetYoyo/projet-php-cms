<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . "/../Models/User.php";
require_once __DIR__ . "/../Repositories/UserRepository.php";

class ForgotPasswordController {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    // Affiche le formulaire de demande de réinitialisation
    public function show(): void {
        $errors = [];
        $success = false;
        require __DIR__ . '/../Views/forgot-password.php';
    }

    // Traite la demande de réinitialisation
    public function request(): void {
        $errors = [];
        $success = false;
        $resetLink = null;
        $token = null;

        if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            !empty($_POST["email"])
        ) {
            $email = strtolower(trim($_POST["email"]));

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Format d'email invalide";
            } else {
                $user = $this->userRepository->getUserByEmail($email);
                if (!$user) {
                    $errors[] = "Cet email n'existe pas dans notre base de données";
                } else {
                    // Générer un token unique
                    $token = bin2hex(random_bytes(32));
                    $expiresAt = date('Y-m-d H:i:s', strtotime('+2 hours'));
                    
                    // Sauvegarder le token
                    $this->saveResetToken($user['id_user'], $token, $expiresAt);
                    
                    // Générer le lien de réinitialisation
                    $resetLink = "http://localhost:8000/reset-password?token=" . $token;
                    
                    $success = true;
                }
            }
        }

        require __DIR__ . '/../Views/forgot-password.php';
    }

    // Affiche le formulaire de réinitialisation
    public function showReset(): void {
        $errors = [];
        $success = false;
        $token = $_GET['token'] ?? '';

        if (empty($token)) {
            $errors[] = "Token invalide ou expiré";
        } else {
            // Vérifier que le token existe et n'a pas expiré
            $tokenData = $this->getValidToken($token);
            if (!$tokenData) {
                $errors[] = "Ce lien de réinitialisation a expiré. Veuillez en demander un nouveau.";
            }
        }

        require __DIR__ . '/../Views/reset-password.php';
    }

    // Traite la réinitialisation du mot de passe
    public function reset(): void {
        $errors = [];
        $success = false;
        $token = $_POST['token'] ?? '';

        if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            !empty($token) &&
            !empty($_POST["pwd"]) &&
            !empty($_POST["confirm_pwd"])
        ) {
            // Vérifier le token
            $tokenData = $this->getValidToken($token);
            if (!$tokenData) {
                $errors[] = "Lien de réinitialisation invalide ou expiré";
            } else {
                $pwd = $_POST["pwd"];
                $confirmPwd = $_POST["confirm_pwd"];

                // Validation du mot de passe
                if (
                    strlen($pwd) < 8 ||
                    !preg_match("#[a-z]#", $pwd) ||
                    !preg_match("#[A-Z]#", $pwd) ||
                    !preg_match("#[0-9]#", $pwd) ||
                    !preg_match("#[-.;?,!]#", $pwd)
                ) {
                    $errors[] = "Le mot de passe doit avoir 8 caractères dont 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial (.;?,-!)";
                } else if ($pwd != $confirmPwd) {
                    $errors[] = "Les mots de passe ne correspondent pas";
                } else {
                    // Mettre à jour le mot de passe
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    $this->updateUserPassword($tokenData['id_user'], $hashedPwd);
                    
                    // Supprimer le token utilisé
                    $this->deleteResetToken($token);
                    
                    $success = true;
                }
            }
        } else {
            $errors[] = "Données manquantes";
        }

        require __DIR__ . '/../Views/reset-password.php';
    }

    // Sauvegarde un token de réinitialisation
    private function saveResetToken($idUser, $token, $expiresAt): void {
        $pdo = new Database();
        $query = $pdo->getConnection()->prepare(
            "INSERT INTO PasswordResetTokens (id_user, token, expires_at) VALUES (:id_user, :token, :expires_at)"
        );
        $query->execute([
            "id_user" => $idUser,
            "token" => $token,
            "expires_at" => $expiresAt
        ]);
    }

    // Retrieve un token valide
    private function getValidToken($token): ?array {
        $pdo = new Database();
        $query = $pdo->getConnection()->prepare(
            "SELECT id_user, token FROM PasswordResetTokens WHERE token = :token AND expires_at > NOW()"
        );
        $query->execute(["token" => $token]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return !empty($result) ? $result[0] : null;
    }

    // Met à jour le mot de passe de l'utilisateur
    private function updateUserPassword($idUser, $hashedPwd): void {
        $pdo = new Database();
        $query = $pdo->getConnection()->prepare(
            "UPDATE Users SET pwd = :pwd WHERE id_user = :id_user"
        );
        $query->execute([
            "pwd" => $hashedPwd,
            "id_user" => $idUser
        ]);
    }

    // Supprime un token après utilisation
    private function deleteResetToken($token): void {
        $pdo = new Database();
        $query = $pdo->getConnection()->prepare(
            "DELETE FROM PasswordResetTokens WHERE token = :token"
        );
        $query->execute(["token" => $token]);
    }
}
