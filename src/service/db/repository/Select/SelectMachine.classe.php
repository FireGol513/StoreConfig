<?php

require_once __DIR__.'/Select.abstract.php';
require_once __DIR__.'/../../model/Machine.model.php';

class SelectMachine extends Select
{
    // Récupérer une machine
    protected Machine $machine;
    protected int $id;
    protected string $nomMachine;
    protected int $idModele;
    protected int $idReseau;
    protected int $api;

    // Récupérer plusieurs machines
    protected array $listeMachines;

    public function __construct($idReseau)
    {
        $this->idReseau = $idReseau;
        $this->machine = new Machine();
        $this->listeMachines = array();
        parent::__construct(); 
    }
    

    
    /**
     * Sélection du user selon le courriel
     */
    public function select($idMachine)
    {
        try {
            $pdoRequete = $this->connexion->prepare("SELECT Mach.*, Mo.NomModele FROM Machines AS Mach LEFT JOIN Modeles AS Mo ON Mach.Modele = Mo.Id  WHERE Mach.Id=:idMachine AND Mach.Actif = :Actif");
    
            $pdoRequete->bindParam(":idMachine",$idMachine,PDO::PARAM_INT);
            $pdoRequete->bindValue(":Actif",1,PDO::PARAM_INT);
        
            $pdoRequete->execute();
    
            $machine = $pdoRequete->fetch(PDO::FETCH_OBJ);

            
            if ($machine){
                
                $this->machine->setId($machine->Id);
                $this->machine->setNomMachine($machine->NomMachine);
                $this->machine->setIdModele($machine->Modele);
                $this->machine->setIdReseau($machine->IdReseau);
                $this->machine->setAPI($machine->API);
                $this->machine->setModele($machine->NomModele);
                
                return $this->machine;
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
        
        $pdoRequete = $this->connexion->prepare("SELECT Mach.*, Mo.NomModele FROM Machines AS Mach LEFT JOIN Modeles AS Mo ON Mach.Modele = Mo.Id WHERE Mach.IdReseau = :IdReseau AND Mach.Actif = :Actif");
    
            $pdoRequete->bindParam(":IdReseau",$this->idReseau,PDO::PARAM_INT);
            $pdoRequete->bindValue(":Actif",1,PDO::PARAM_INT);
            $pdoRequete->execute();
    
            $machines = $pdoRequete->fetchAll(PDO::FETCH_OBJ);

            $numMachine = 0;
            foreach ($machines as $obj) {
                $machine = new Machine();
                $machine->setId($obj->Id);
                $machine->setNomMachine($obj->NomMachine);
                $machine->setIdModele($obj->Modele);
                $machine->setIdReseau($obj->IdReseau);
                $machine->setAPI($obj->API);
                $machine->setModele($obj->NomModele);

                $this->listeMachines[$numMachine] = $machine;
                $numMachine++;
            }
            return $this->listeMachines;

            
     }
}


