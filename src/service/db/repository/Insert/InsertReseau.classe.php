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

            error_log("[".date("d/m/o H:i:s e",time())."] Réseau '".$this->nomReseau."' a été inséré correctement dans la BD: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../../../logs/insertion-bd.log");
            return true;

        } catch (Exception $e) {
            error_log("[".date("d/m/o H:i:s e",time())."] Exception pdo: ".$e->getMessage().": Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../../../logs/insertion-bd.log");
            return false;
        }        
    }

}


?>