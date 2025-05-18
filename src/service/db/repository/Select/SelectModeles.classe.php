<?php

require_once __DIR__.'/Select.abstract.php';
require_once __DIR__.'/../../model/Machine.model.php';

class SelectModeles extends Select
{
    public function __construct()
    {
        
        parent::__construct(); 
    }
    

    
    /**
     * Sélection du user selon le courriel
     */
    public function select($null)
    {
        return;
    }



    /**
     * Sélection de plusieurs users
     */

     public function selectMultiple()
     {
        
        $pdoRequete = $this->connexion->prepare("SELECT * FROM Modeles");
    
        
            $pdoRequete->execute();
    
            $modeles = $pdoRequete->fetchAll(PDO::FETCH_OBJ);

            if ($modeles){
                return $modeles;
            }
  
     }
}


