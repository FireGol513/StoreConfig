<?php

class Reseau{

    private int $id;
    private string $nomReseau;
    private int $idProprietaire;

    /**
     * Setter le réseau
     */
    public function setId(int $p)
    {
        $this->id = $p;
    }

    public function setNomReseau(string $p) 
    {
        $this->nomReseau = $p;
    }

    public function setIdProprietaire(int $p)
    {
        $this->idProprietaire = $p;
    }



    /**
     * Getter le réseau
     */
    public function getId()
    {
        return $this->id;
    }

    public function getNomReseau() 
    {
        return $this->nomReseau;
    }

    public function getIdProprietaire()
    {
        return $this->idProprietaire;
    }

}


?>
