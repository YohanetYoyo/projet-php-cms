<?php

namespace App\Repositories;

use App\Models\Page;
use Database;

class PageRepository
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    //Récupérer toutes les pages
    public function findAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM pages ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    //Récupérer une page par son ID

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM pages WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ?: null;
    
    }

    //Récuperer une page par son slug

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM pages WHERE slug = :slug");
        $stmt->execute(['slug' => $slug]);
        $resultat = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $resultat ?: null;
    }

    //Créer une nouvelle page

    public function create(array $data) : bool
    {
        $stmt = $this->db->prepare("
        INSERT INTO pages (title, slug, content, created_at, updated_at)
        VAlUES (:title, :slug, :content, NOW(), NOW())
        ");
        return $stmt->execute([
            ':title'  => $data['title'],
            ':slug'   => $data['slug'],
            ':content' => $data['content']
            ]);
    }

    //Mettre à jour une page existante

    public function update(int $id, array $data) : bool
    {
        $stmt = $this->db->prepare("
        UPDATE pages
        SET title = :title, slug = :slug, content = :content, update_at =NOW()
        WHERE id = :id
        ");
        return $stmt->execute([
            ':title' => $data['title'],
            ':slug' => $data['slug'],
            ':content' => $data['content'],
            ':id' => $id
        ]);
    }

    //Supprimer une page

    public function delete(int $id) : bool
    {
        $stmt = $this->db->prepare("DELETE FROM pages WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    //Vérifier l'existence d'une page par son slug

    public function slugExists(string $slug, ?int $execludeId = null) : bool
    {
        $sql = "SELECT COUNT(*) FROM pages WHERE slug = :slug";
        if ($execludeId) {
            $sql = " AND id != :id";
        }
        $stmt = $this->db->prepare($sql);
        $params = [':slug' => $slug];
        if ($execludeId) {
            $params[':id'] = $execludeId;
        }
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    
    }

}