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

            error_log("[".date("d/m/o H:i:s e",time())."] Utilisateur '".$this->nomUtilisateur."' a été inséré correctement dans la BD: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../../../logs/insertion-bd.log");
            return true;

        } catch (Exception $e) {
            error_log("[".date("d/m/o H:i:s e",time())."] Exception pdo: ".$e->getMessage().": Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../../../logs/insertion-bd.log");
            return false;
        }        
    }

}


