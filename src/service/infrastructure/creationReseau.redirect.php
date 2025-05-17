<?php

require_once __DIR__."/../db/repository/Insert/InsertReseau.classe.php";
require_once __DIR__.'/../session/SessionFinale.include.php';

$sessionConnecte = new SessionFinale();
session_start();
$sessionConnecte->validerSession();


if (!empty($_POST["nomReseau"])){

    $nomReseau = filter_input(INPUT_POST, "nomReseau", FILTER_DEFAULT);

    if ($nomReseau){

        $requeteCreerReseau = new InsertReseau();
        $requeteCreerReseau->setParams($nomReseau, $_SESSION["idUtilisateur"]);

        if ($requeteCreerReseau->insert()){
            header("Location: /storeconfig/panneauConfig/machines.php?reseau=");
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