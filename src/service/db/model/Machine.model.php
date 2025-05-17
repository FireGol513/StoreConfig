<?php

class Machine{

    private int $id;
    private string $nomMachine;
    private int $idModele;
    private string $modele;
    private int $idReseau;
    private int $api;

    /**
     * Setter le réseau
     */
    public function setId(int $p)
    {
        $this->id = $p;
    }

    public function setNomMachine(string $p) 
    {
        $this->nomMachine = $p;
    }

    public function setIdModele(int $p)
    {
        $this->idModele = $p;
    }
    
    public function setModele(string $p)
    {
        $this->modele = $p;
    }

    public function setIdReseau(int $p) 
    {
        $this->idReseau = $p;
    }

    public function setAPI(int $p)
    {
        $this->api = $p;
    }




    /**
     * Getter le réseau
     */
    public function getId()
    {
        return $this->id;
    }

    public function getNomMachine() 
    {
        return $this->nomMachine;
    }

    public function getIdModele()
    {
        return $this->idModele;
    }


    public function getModele(string $p)
    {
        return $this->modele;
    }

    public function getIdReseau(int $p) 
    {
        return $this->idReseau;
    }

    public function getAPI(int $p)
    {
        return $this->api;
    }

}


?>
