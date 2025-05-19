<?php

require_once __DIR__."/../session/Session2FA.include.php";
require_once __DIR__."/../session/SessionFinale.include.php";


function CreerSessionFinaleConnecte(int $idUtilisateur, string $nomUtilisateur, Session2FA $sessionASupprimer){
    
    $sessionASupprimer->supprimer();
    $sessionFinale = new SessionFinale();
    session_start();
    $sessionFinale->setSession($nomUtilisateur, null, $idUtilisateur);
}

// Reprendre session 2FA
$session2FA = new Session2FA();
session_start();
$session2FA->validerSession();

if (isset($_POST["Code2FA"]) && isset($_SESSION["code"]) && isset($_SESSION["courriel"]) && isset($_SESSION["nomUtilisateur"])){
    
    $code2FA = filter_input(INPUT_POST, "Code2FA", FILTER_VALIDATE_INT);
    $nomUtilisateur = $_SESSION["nomUtilisateur"];
    $idUtilisateur = $_SESSION["idUtilisateur"];

    if (!isset($code2FA)){
        error_log("[".date("d/m/o H:i:s e",time())."] 2FA impossible. Le code de 2FA n'ai pas numérique: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/acces-refuses.log");
        header("Location: /storeconfig/connexion/2FA.php?erreur=mauvaisCode");
        exit();
    }

    if ($code2FA == $_SESSION["code"]){
        session_destroy();
        CreerSessionFinaleConnecte($idUtilisateur, $nomUtilisateur, $session2FA);
        error_log("[".date("d/m/o H:i:s e",time())."] 2FA impossible. Le code n'est pas le bon: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/acces-reussis.log");
        header("Location: ../../index.php");
    }
    else{
        error_log("[".date("d/m/o H:i:s e",time())."] 2FA impossible. Le code n'est pas le bon: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/acces-refuses.log");
        header("Location: /storeconfig/connexion/2FA.php?erreur=mauvaisCode");
    }
}else{
    error_log("[".date("d/m/o H:i:s e",time())."] 2FA impossible. Aucun code 2FA n'a été récupérer: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/acces-refuses.log");
        header("Location: /storeconfig/connexion/2FA.php?erreur=mauvaisCode");
}


?>