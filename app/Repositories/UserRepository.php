<?php
require_once __DIR__ . '/../../config/Database.php';

class UserRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = new Database();
    }

    public function insertUser(User $user): false|string {
        $query = $this->pdo->getConnection()->prepare("INSERT INTO Users (lastname, firstname, email, pwd, is_admin, created_at) VALUES (:lastname, :firstname, :email, :pwd, :is_admin, :created_at)");
        $query->execute(array(
            "lastname" => $user->getLastname(),
            "firstname" => $user->getFirstname(),
            "email" => $user->getEmail(),
            "pwd" => $user->getPwd(),
            "is_admin" => $user->getIsAdmin(),
            "created_at" => $user->getCreatedAt()
        ));
        return $this->pdo->getConnection()->lastInsertId();
    }

    public function deleteUser($id): void {
        $query = $this->pdo->getConnection()->prepare("DELETE FROM Users WHERE id_user = :id");
        $query->execute(["id" => $id]);
    }

    public function getUserByEmail($email): array {
        $query = $this->pdo->getConnection()->prepare("SELECT id_user, lastname, firstname, email, is_admin, created_at FROM Users WHERE email = :email");
        $query->execute(["email" => $email]);
        return $query->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public function checkEmail($email) {
        $query = $this->pdo->getConnection()->prepare("SELECT id_user FROM Users WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        return $query->fetchColumn();
    }

    public function checkPassword($email) {
        $query = $this->pdo->getConnection()->prepare("SELECT pwd FROM Users WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        return $query->fetchColumn();
    }
}