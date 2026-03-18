<?php
class PageUserRoles {
    private $idUser;
    private $idPage;
    private $idRole;

    public function __construct(array $donnees) {
        $this->hydrate($donnees);
    }

    private function hydrate(array $donnees): void {
        foreach($donnees as $key => $value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method)){
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

    public function getIdPage() {
        return $this->idPage;
    }

    public function setIdPage($idPage): void {
        $this->idPage = $idPage;
    }

    public function getIdRole() {
        return $this->idRole;
    }

    public function setIdRole($idRole): void {
        $this->idRole = $idRole;
    }

}