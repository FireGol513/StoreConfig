<?php

class Interfaces{

    private int $id;
    private string $idMachine;
    private string $nom;
    private int $idType;
    private string $addressMAC;
    private string $addressIP;
    private int $cidr;
    private string $paserelle;
    private string $commentaires;


    /**
     * Setter le réseau
     */
    public function setId(int $p)
    {
        $this->id = $p;
    }

    public function setIdMachine(int $p) 
    {
        $this->idMachine = $p;
    }

    public function setNom(string $p)
    {
        $this->nom = $p;
    }
    
    public function setIdType(int $p)
    {
        $this->idType = $p;
    }

    public function setAddressMAC(string $p) 
    {
        $this->addressMAC = $p;
    }

    public function setAddressIP(string $p)
    {
        $this->addressIP = $p;
    }

    public function setCidr(int $p)
    {
        $this->cidr = $p;
    }

    public function setPaserelle(string $p) 
    {
        $this->paserelle = $p;
    }

    public function setCommentaires(string $p)
    {
        $this->commentaires = $p;
    }




    /**
     * Getter le réseau
     */
    public function getId()
    {
        return $this->id;
    }

    public function getIdMachine() 
    {
        return $this->idMachine;
    }

    public function getNom()
    {
        return $this->nom;
    }
    
    public function getIdType()
    {
        return $this->idType;
    }

    public function getAddressMAC() 
    {
        return $this->addressMAC;
    }

    public function getAddressIP()
    {
        return $this->addressIP;
    }

    public function getCidr()
    {
        return $this->cidr;
    }

    public function getPaserelle() 
    {
        return $this->paserelle;
    }

    public function getCommentaires()
    {
        return $this->commentaires;
    }

}


?>
