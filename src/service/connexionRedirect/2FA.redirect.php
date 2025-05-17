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
        error_log("[".date("d/m/o H:i:s e",time())."] 2FA impossible. Le code de 2FA n'ai pas numérique: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/storeconfig.acces.log");
        header("Location: ../../erreur/erreur.php");
        exit();
    }

    if ($code2FA == $_SESSION["code"]){
        session_destroy();
        CreerSessionFinaleConnecte($idUtilisateur, $nomUtilisateur, $session2FA);
        header("Location: ../../index.php");
    }
    else{
        error_log("[".date("d/m/o H:i:s e",time())."] 2FA impossible. Le code de 2FA ne correspond pas: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/storeconfig.acces.log");
        header("Location: ../../erreur/erreur.php");
    }
}else{
    error_log("[".date("d/m/o H:i:s e",time())."] 2FA impossible. Aucun code de 2FA n'a été récupéré: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/storeconfig.acces.log");
    header("Location: ../../erreur/erreur.php");
}


?>