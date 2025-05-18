<?php

require_once __DIR__."/../db/repository/Insert/InsertMachine.classe.php";
require_once __DIR__.'/../session/SessionFinale.include.php';

$sessionConnecte = new SessionFinale();
session_start();
$sessionConnecte->validerSession();


if (!empty($_POST["nomMachine"]) || !empty($_POST["idReseau"]) || !empty($_POST["modele"])){

    $nomMachine = filter_input(INPUT_POST, "nomMachine", FILTER_DEFAULT);
    $idReseau = filter_input(INPUT_POST, "idReseau", FILTER_VALIDATE_INT);
    $idModele = filter_input(INPUT_POST, "modele", FILTER_VALIDATE_INT);

    $utiliseAPI = filter_input(INPUT_POST, "utiliseAPI", FILTER_VALIDATE_BOOL);
    $adresseAPI = filter_input(INPUT_POST, "adresseAPI", FILTER_DEFAULT);
    $nomUtilisateurAPI = filter_input(INPUT_POST, "nomUtilisateurAPI", FILTER_DEFAULT);
    $mdpAPI = filter_input(INPUT_POST, "mdpAPI", FILTER_DEFAULT);

    if ($nomMachine && $idReseau && $idModele){

        $requeteCreerMachine = new InsertMachine();
        $requeteCreerMachine->setParams($nomMachine, $idModele, $idReseau, $utiliseAPI, $adresseAPI, $nomUtilisateurAPI, $mdpAPI);

        if ($requeteCreerMachine->insert()){
            $id = $requeteCreerMachine->getIdMachineCreer();
            header("Location: /storeconfig/panneauConfig/machine.php?modifier=".$id."");
        }

    }
    else{
        error_log("[".date("d/m/o H:i:s e",time())."] Échec de création de réseau - Le réseau a un nom qu n'est pas permis: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/infrastructure.log");
        header("Location: /storeconfig/panneauConfig/index.php?erreur=nomReseau");
    }

}
else{
    error_log("[".date("d/m/o H:i:s e",time())."] Échec de création de réseau - Le réseau n'a pas de nom: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/infrastructure.log");
    header("Location: /storeconfig/panneauConfig/index.php?erreur=nomReseau");
}

?>