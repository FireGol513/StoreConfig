<?php

require_once __DIR__.'/Insert.abstract.php';
require_once __DIR__.'/../../../encryption/encryption.classe.php';

class InsertMachine extends Insert
{
    protected string $nomMachine;
    protected int $idModele;
    protected int $idReseau;
    protected int $utiliseAPI;

    // Parametres pour L'API
    protected int $idMachineCreer;
    protected ?string $adresseAPI;
    protected ?string $nomUtilisateurAPI;
    protected ?string $mdpAPI;

    // Construit la connexion dans le parent
    public function __construct()
    {
        parent::__construct(); 
    }

    public function setParams($nomMachine, $idModele, $idReseau, $utiliseAPI, $adresseAPI, $nomUtilisateurAPI, $mdpAPI){
        $this->nomMachine = $nomMachine;
        $this->idModele  = $idModele;
        $this->idReseau = $idReseau;
        if ($utiliseAPI == "on"){
            $this->utiliseAPI = 1;
        }else{
            $this->utiliseAPI = 0;
        }
        
        $this->adresseAPI  = $adresseAPI;
        $this->nomUtilisateurAPI = $nomUtilisateurAPI;
        $this->mdpAPI = $mdpAPI;

    }


    public function getIdMachineCreer(){
        return $this->idMachineCreer;
    }


    /**
     * Insertion de l'utilisateur dans la bd
     */
    public function insert()
    {
        try {
            // Insertion de la machine dans la BD
            $pdoRequete = $this->connexion->prepare("INSERT INTO Machines (Actif, NomMachine, Modele, IdReseau, API) VALUES (:Actif, :NomMachine, :Modele, :IdReseau, :API);");
    
            $pdoRequete->bindValue(":Actif",1,PDO::PARAM_INT);
            $pdoRequete->bindParam(":NomMachine",$this->nomMachine,PDO::PARAM_STR);
            $pdoRequete->bindParam(":Modele",$this->idModele,PDO::PARAM_INT);
            $pdoRequete->bindParam(":IdReseau",$this->idReseau,PDO::PARAM_STR);
            $pdoRequete->bindParam(":API",$this->utiliseAPI,PDO::PARAM_BOOL);
            $pdoRequete->execute();

            $this->idMachineCreer = $this->connexion->lastInsertId();



        } catch (Exception $e) {
            error_log("Exception pdo: ".$e->getMessage());
            return false;
        }        


        // Insertion de l'API

        if ($this->adresseAPI && $this->nomUtilisateurAPI && $this->mdpAPI && $this->utiliseAPI == 1){

            $encrypteur = new Encryption();
            $adresseAPIChiffrer = $encrypteur->chiffrer($this->adresseAPI);
            $nomUtilisateurAPIChiffrer = $encrypteur->chiffrer($this->nomUtilisateurAPI);
            $mdpAPIChiffrer = $encrypteur->chiffrer($this->mdpAPI);


            try {
                // Insertion de l'API dans la BD
                $pdoRequete = $this->connexion->prepare("INSERT INTO API (IdMachine, AdresseServeur, NomUtilisateur, MDP) VALUES (:IdMachine,:AdresseServeur,:NomUtilisateur,:MDP);");
        
                $pdoRequete->bindParam(":IdMachine",$this->getIdMachineCreer(),PDO::PARAM_INT);
                $pdoRequete->bindParam(":AdresseServeur",$adresseAPIChiffrer,PDO::PARAM_STR);
                $pdoRequete->bindParam(":NomUtilisateur",$nomUtilisateurAPIChiffrer,PDO::PARAM_STR);
                $pdoRequete->bindParam(":MDP",$mdpAPIChiffrer,PDO::PARAM_STR);
                $pdoRequete->execute();


            } catch (Exception $e) {
                error_log("Exception pdo: ".$e->getMessage());
                return false;
            }        
        }
        return true;

            
    }

}

?>
