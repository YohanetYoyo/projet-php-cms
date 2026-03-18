<?php
class Role {
    private $idRole;
    private $name;

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

    public function getIdRole() {
        return $this->idRole;
    }

    public function setIdRole($idRole): void {
        $this->idRole = $idRole;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name): void {
        $this->name = $name;
    }

}