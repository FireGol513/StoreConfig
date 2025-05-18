<?php

require_once __DIR__.'/Select.abstract.php';
require_once __DIR__.'/../../model/Reseau.model.php';

class SelectReseau extends Select
{

    // Récupérer un réseau
    protected Reseau $reseau;
    protected int $id;
    protected string $nomReseau;
    protected int $idProprietaire;

    // Récupérer plusieurs réseaux
    protected array $listeReseaux;


    public function __construct($idProprietaire)
    {
        $this->idProprietaire = $idProprietaire;
        $this->reseau = new Reseau();
        $this->listeReseaux = array();
        parent::__construct(); 
    }
    

    
    /**
     * Sélection du user selon le courriel
     */
    public function select($idReseau)
    {
        try {
            $pdoRequete = $this->connexion->prepare("SELECT * FROM Reseaux WHERE Id=:idReseau");
    
            $pdoRequete->bindParam(":idReseau",$idReseau,PDO::PARAM_INT);
        
            $pdoRequete->execute();
    
            $reseau = $pdoRequete->fetch(PDO::FETCH_OBJ);

            if ($reseau){
                $this->reseau->setId($reseau->Id);
                $this->reseau->setNomReseau($reseau->NomReseau);
                $this->reseau->setIdProprietaire($reseau->IdProprietaire);
    
                return $this->reseau;
            }
            
    
        } catch (Exception $e) {
            error_log("Exception pdo: ".$e->getMessage());
        }        
    }



    /**
     * Sélection de plusieurs users
     */

     public function selectMultiple()
     {
        $pdoRequete = $this->connexion->prepare("SELECT * FROM Reseaux WHERE IdProprietaire=:idProprietaire AND Actif=:actif");
    
            $pdoRequete->bindParam(":idProprietaire",$this->idProprietaire,PDO::PARAM_INT);
            $pdoRequete->bindValue(":actif",1,PDO::PARAM_BOOL);
        
            $pdoRequete->execute();
    
            $reseaux = $pdoRequete->fetchAll(PDO::FETCH_OBJ);


            if ($reseaux){

                $numReseau = 0;
                foreach ($reseaux as $obj) {
                    $reseau = new Reseau();
                    $reseau->setId($obj->Id);
                    $reseau->setNomReseau($obj->NomReseau);
                    $reseau->setIdProprietaire($obj->IdProprietaire);

                    $this->listeReseaux[$numReseau] = $reseau;
                    $numReseau++;
                }
                return $this->listeReseaux;

            }
     }
}


