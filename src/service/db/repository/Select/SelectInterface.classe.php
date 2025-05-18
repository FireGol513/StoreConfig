<?php

require_once __DIR__.'/Select.abstract.php';
require_once __DIR__.'/../../model/Interfaces.model.php';

class SelectInterface extends Select
{
    // Récupérer une interface
    protected Interfaces $interface;
    protected int $id;
    protected int $idMachine;
    protected string $nomInterface;
    protected int $idType;
    protected string $addressMAC;
    protected string $addressIP;
    protected int $cidr;
    protected string $passerelle;
    protected string $commentaires;


    // Récupérer plusieurs interfaces
    protected array $listeInterfaces;


    public function __construct($idMachine)
    {
        $this->idMachine = $idMachine;
        $this->interface = new Interfaces();
        $this->listeInterfaces = array();
        parent::__construct(); 
    }
    
    
    
    /**
     * Sélection du user selon le courriel
     */
    public function select($idInterface)
    {
        try {
            $pdoRequete = $this->connexion->prepare("SELECT * FROM Interfaces WHERE Id = :IdInterface AND Actif = :Actif;");
            
    
            $pdoRequete->bindParam(":IdInterface",$idInterface,PDO::PARAM_INT);
            $pdoRequete->bindValue(":Actif",1,PDO::PARAM_INT);
        
            $pdoRequete->execute();
    
            $interface = $pdoRequete->fetch(PDO::FETCH_OBJ);

            
            if ($interface){
                
                $this->interface->setId($interface->Id);
                $this->interface->setIdMachine($interface->IdMachine);
                $this->interface->setNom($interface->Nom);
                $this->interface->setIdType($interface->IdType);
                $this->interface->setAddressMAC($interface->AddressMAC);
                $this->interface->setAddressIP($interface->AddressIP);
                $this->interface->setCidr($interface->CIDR);
                $this->interface->setPaserelle($interface->Passerelle);
                $this->interface->setCommentaires($interface->Commentaires);
                
                return $this->interface;
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
        
        $pdoRequete = $this->connexion->prepare("SELECT * FROM Interfaces WHERE IdMachine = :IdMachine  AND Actif = :Actif;");
    
            $pdoRequete->bindParam(":IdMachine",$this->idMachine,PDO::PARAM_INT);
            $pdoRequete->bindValue(":Actif",1,PDO::PARAM_INT);
            $pdoRequete->execute();
    
            $interfaces = $pdoRequete->fetchAll(PDO::FETCH_OBJ);

            $numInterfaces = 0;
            foreach ($interfaces as $obj) {
                $interface = new Interfaces();
                $interface->setId($obj->Id);
                $interface->setIdMachine($obj->IdMachine);
                $interface->setNom($obj->Nom);
                $interface->setIdType($obj->IdType);
                $interface->setAddressMAC($obj->AddressMAC);
                $interface->setAddressIP($obj->AddresseIP);
                $interface->setCidr($obj->CIDR);
                $interface->setPaserelle($obj->Passerelle);
                $interface->setCommentaires($obj->Commentaires);

                $this->listeInterfaces[$numInterfaces] = $interface;
                $numInterfaces++;
            }
            return $this->listeInterfaces;

            
     }
}


