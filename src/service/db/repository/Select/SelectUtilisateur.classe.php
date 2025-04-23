<?php

require_once __DIR__.'/Select.abstract.php';
require_once __DIR__.'/../../model/Utilisateur.model.php';

class SelectUtilisateur extends Select
{
    protected int $id;
    protected string $nomUtilisateur;
    protected string $courriel;
    protected string $mdp;
    protected Utilisateur $user;

    public function __construct($courriel)
    {
        $this->courriel = $courriel;
        $this->user = new Utilisateur();
        parent::__construct(); 
    }
    

    
    /**
     * Sélection du user selon le courriel
     */
    public function select()
    {
        try {
            $pdoRequete = $this->connexion->prepare("SELECT * FROM Utilisateurs WHERE Courriel=:courriel");
    
            $pdoRequete->bindParam(":courriel",$this->courriel,PDO::PARAM_STR);
        
            $pdoRequete->execute();
    
            $user = $pdoRequete->fetch(PDO::FETCH_OBJ);

            if ($user){
                $this->user->setId($user->Id);
                $this->user->setNomUtilisateur($user->NomUtilisateur);
                $this->user->setCourriel($user->Courriel);
                $this->user->setMdp($user->MDP);
    
                return $this->user;
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
        null;
     }
}


