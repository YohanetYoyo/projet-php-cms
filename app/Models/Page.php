<?php
class Page {
    private $idPage;
    private $title;
    private $content;
    private $slug;
    private $status;
    private $author;
    private $createdAt;

    public function __construct(array $donnees) {
        $this->hydrate($donnees);
    }

    private function hydrate(array $donnees): void {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getIdPage() {
        return $this->idPage;
    }

    public function setIdPage($idPage): void {
        $this->idPage = $idPage;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title): void {
        $this->title = $title;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function setSlug($slug): void {
        $this->slug = $slug;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author): void {
        $this->author = $author;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): void {
        $this->createdAt = $createdAt;
    }

}