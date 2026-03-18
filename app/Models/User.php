<?php
class User {
    private $idUser;
    private $lastname;
    private $firstname;
    private $email;
    private $pwd;
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

    public function getIdUser() {
        return $this->idUser;
    }

    public function setIdUser($idUser): void {
        $this->idUser = $idUser;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname): void {
        $this->lastname = $lastname;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($firstname): void {
        $this->firstname = $firstname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function getPwd() {
        return $this->pwd;
    }

    public function setPwd($pwd): void {
        $this->pwd = $pwd;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): void {
        $this->createdAt = $createdAt;
    }

}