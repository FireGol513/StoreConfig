<?php

require_once __DIR__.'/Insert.abstract.php';

class InsertReseau extends Insert
{
    protected string $nomReseau;
    protected string $idProprietaire;

    protected int $idReseauCreer;

    // Construit la connexion dans le parent
    public function __construct()
    {
        parent::__construct(); 
    }

    public function setParams($nomReseauACreer, $idProprietaire){
        $this->nomReseau = $nomReseauACreer;
        $this->idProprietaire  = $idProprietaire;
    }


    public function getIdReseauCreer(){
        return $this->idReseauCreer;
    }


    /**
     * Insertion de l'utilisateur dans la bd
     */
    public function insert()
    {
        try {
            // Insertion de l'utilisateur dans la bd
            $pdoRequete = $this->connexion->prepare("INSERT INTO Reseaux (Actif, NomReseau, IdProprietaire) VALUE (:actif, :nomReseau, :idProprietaire);");
    
            $pdoRequete->bindValue(":actif",1,PDO::PARAM_BOOL);
            $pdoRequete->bindParam(":nomReseau",$this->nomReseau,PDO::PARAM_STR);
            $pdoRequete->bindParam(":idProprietaire",$this->idProprietaire,PDO::PARAM_INT);
            $pdoRequete->execute();

            $this->idReseauCreer = $this->connexion->lastInsertId();


            return true;

        } catch (Exception $e) {
            error_log("Exception pdo: ".$e->getMessage());
            return false;
        }        
    }

}


?>