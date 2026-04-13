<?php
require_once __DIR__ .'/../../config/Database.php';

class PageUserRolesRepository {
    private $pdo;
    public function __construct() {
        $this->pdo = new Database();
    }


    public function insert(PageUserRoles $pageUserRoles): void {
        $query = $this->pdo->getConnection()->prepare(
            "
            INSERT INTO PageUserRoles (id_user, id_page, id_role) VALUES (:id_user, :id_page, :id_role)"
        );
        $query->execute([
            "id_user" => $pageUserRoles->getIdUser(),
            "id_page" => $pageUserRoles->getIdPage(),
            "id_role" => $pageUserRoles->getIdRole(),
        ]);
    }

    public function update(PageUserRoles $pageUserRoles): void {
        $query = $this->pdo->getConnection()->prepare(
            "UPDATE PageUserRoles SET id_role = :id_role WHERE id_user = :id_user AND id_page = :id_page"
        );
        $query->execute([
            "id_role" => $pageUserRoles->getIdRole(),
            "id_user" => $pageUserRoles->getIdUser(),
            "id_page" => $pageUserRoles->getIdPage()
        ]);
    }

    public function delete(int $idUser, int $idPage): void {
        $query = $this->pdo->getConnection()->prepare(
            "DELETE FROM PageUserRoles WHERE id_user = :id_user AND id_page = :id_page"
        );
        $query->execute([
            "id_user" => $idUser,
            "id_page" => $idPage,
        ]);
    }

    public function getByUserAndPage(int $idUser, int $idPage): ?array {
        $query = $this->pdo->getConnection()->prepare(
            "SELECT * FROM PageUserRoles WHERE id_user = :id_user AND id_page = :id_page" 
        );
        $query->execute([
           "id_user" => $idUser,
           "id_page" => $idPage
         ]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result[0] ?? null;
    }

    public function getOtherUsersOnPage(int $idUser, int $idPage): ?array {
        $query = $this->pdo->getConnection()->prepare(
            "SELECT pur.id_user, u.lastname, u.firstname, pur.id_role, r.name FROM PageUserRoles pur INNER JOIN Users as u ON u.id_user = pur.id_user INNER JOIN Roles as r ON r.id_role = pur.id_role WHERE pur.id_user != :id_user AND pur.id_page = :id_page"
        );
        $query->execute([
            "id_user" => $idUser,
            "id_page" => $idPage
        ]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result ?? null;
    }
}