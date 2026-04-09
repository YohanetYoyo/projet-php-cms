<?php
require_once __DIR__ . '/../../config/Database.php';

class RoleRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = new Database();
    }

    // Insère un nouveau rôle
    // Paramètre: $role (objet Role)
    public function insert(Role $role): void {
        $query = $this->pdo->getConnection()->prepare(
            "INSERT INTO Roles (name) VALUES (:name)"
        );
        $query->execute([
            "name" => $role->getName()
        ]);
    }

    // Met à jour un rôle
    // Paramètre: $role (objet Role)
    public function update(Role $role): void {
        $query = $this->pdo->getConnection()->prepare(
            "UPDATE Roles SET name = :name WHERE id_role = :id_role"
        );
        $query->execute([
            "name" => $role->getName(),
            "id_role" => $role->getIdRole()
        ]);
    }

    // Supprime un rôle
    // Paramètre: $id (ID du rôle)
    public function delete(int $id): void {
        $query = $this->pdo->getConnection()->prepare(
            "DELETE FROM Roles WHERE id_role = :id"
        );
        $query->execute(["id" => $id]);
    }

    // Récupère tous les rôles
    public function getAll(): array {
        $query = $this->pdo->getConnection()->query(
            "SELECT id_role, name FROM Roles"
        );
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère un rôle par son ID
    // Paramètre: $id (ID du rôle)
    public function getById(int $id): ?array {
        $query = $this->pdo->getConnection()->prepare(
            "SELECT id_role, name FROM Roles WHERE id_role = :id"
        );
        $query->execute(["id" => $id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result[0];
        }
        return null;
    }

    // Récupère un rôle par son nom
    // Paramètre: $name (nom du rôle)
    public function getByName(string $name): ?array {
        $query = $this->pdo->getConnection()->prepare(
            "SELECT id_role, name FROM Roles WHERE name = :name"
        );
        $query->execute(["name" => $name]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result[0];
        }
        return null;
    }
}
