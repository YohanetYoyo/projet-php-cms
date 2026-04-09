<?php
require_once __DIR__ . '/../../config/Database.php';

class PageRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = new Database();
    }

    // Insère une nouvelle page
    // Paramètre: $page (objet Page)
    public function insert(Page $page): void {
        $query = $this->pdo->getConnection()->prepare(
            "INSERT INTO Pages (title, content, slug, status, author, created_at) VALUES (:title, :content, :slug, :status, :author, :created_at)"
        );
        $query->execute([
            "title" => $page->getTitle(),
            "content" => $page->getContent(),
            "slug" => $page->getSlug(),
            "status" => $page->getStatus(),
            "author" => $page->getAuthor(),
            "created_at" => $page->getCreatedAt()
        ]);
    }

    // Met à jour une page
    // Paramètre: $page (objet Page)
    public function update(Page $page): void {
        $query = $this->pdo->getConnection()->prepare(
            "UPDATE Pages SET title = :title, content = :content, slug = :slug, status = :status, author = :author WHERE id_page = :id_page"
        );
        $query->execute([
            "title" => $page->getTitle(),
            "content" => $page->getContent(),
            "slug" => $page->getSlug(),
            "status" => $page->getStatus(),
            "author" => $page->getAuthor(),
            "id_page" => $page->getIdPage()
        ]);
    }

    // Supprime une page
    // Paramètre: $id (ID de la page)
    public function delete(int $id): void {
        $query = $this->pdo->getConnection()->prepare(
            "DELETE FROM Pages WHERE id_page = :id"
        );
        $query->execute(["id" => $id]);
    }

    // Récupère toutes les pages
    public function getAll(): array {
        $query = $this->pdo->getConnection()->query(
            "SELECT id_page, title, content, slug, status, author, created_at FROM Pages ORDER BY created_at DESC"
        );
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère une page par son ID
    // Paramètre: $id (ID de la page)
    public function getById(int $id): ?array {
        $query = $this->pdo->getConnection()->prepare(
            "SELECT id_page, title, content, slug, status, author, created_at FROM Pages WHERE id_page = :id"
        );
        $query->execute(["id" => $id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result[0];
        }
        return null;
    }

    // Récupère une page par son slug
    // Paramètre: $slug (slug de la page)
    public function getBySlug(string $slug): ?array {
        $query = $this->pdo->getConnection()->prepare(
            "SELECT id_page, title, content, slug, status, author, created_at FROM Pages WHERE slug = :slug"
        );
        $query->execute(["slug" => $slug]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result[0];
        }
        return null;
    }

    // Récupère les pages par statut
    // Paramètre: $status (statut de la page)
    public function getByStatus(string $status): array {
        $query = $this->pdo->getConnection()->prepare(
            "SELECT id_page, title, content, slug, status, author, created_at FROM Pages WHERE status = :status ORDER BY created_at DESC"
        );
        $query->execute(["status" => $status]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}