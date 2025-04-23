<?php

require_once __DIR__.'/Insert.abstract.php';
require_once __DIR__.'/../Select/SelectUtilisateur.classe.php';

class InsertUtilisateur extends Insert
{
    protected string $nomUtilisateur;
    protected string $courriel;
    protected string $mdp;


    // Construit la connexion dans le parent
    public function __construct()
    {
        parent::__construct(); 
    }

    public function setParams($nomUtilisateur, $courriel, $mdp){
        $this->nomUtilisateur = $nomUtilisateur;
        $this->courriel = $courriel;
        $this->mdp = $mdp;
    }

    /**
     * Insertion de l'utilisateur dans la bd
     */
    public function insert()
    {
        try {
            // Insertion de l'utilisateur dans la bd
            $pdoRequete = $this->connexion->prepare("INSERT INTO Utilisateurs (NomUtilisateur, Courriel, MDP) VALUE (:nomUtilisateur, :courriel, :mdp);");
    
            $pdoRequete->bindParam(":nomUtilisateur",$this->nomUtilisateur,PDO::PARAM_STR);
            $pdoRequete->bindParam(":courriel",$this->courriel,PDO::PARAM_STR);
            $pdoRequete->bindParam(":mdp",$this->mdp,PDO::PARAM_STR);
            $pdoRequete->execute();

            return true;

        } catch (Exception $e) {
            error_log("Exception pdo: ".$e->getMessage());
            return false;
        }        
    }

}


