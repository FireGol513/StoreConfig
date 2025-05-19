<?php

require_once "../db/repository/Select/SelectUtilisateur.classe.php";
require_once "../session/Session2FA.include.php";


function CreerSession2FA(string $nomUtilisateur, string $courriel, int $idUtilisateur) {
    $session = new Session2FA();
    session_start();
    $session->setSession($nomUtilisateur, $courriel, $idUtilisateur);
}


if (!empty($_POST['courriel']) and !empty($_POST['mdp'])){

    $courriel = filter_input(INPUT_POST, "courriel", FILTER_VALIDATE_EMAIL);
    $mdp = filter_input(INPUT_POST, "mdp", FILTER_DEFAULT);

    if (empty($courriel)){
        error_log("[".date("d/m/o H:i:s e",time())."] Authentification anormal - mail n'a pas la forme demandé: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/acces-refuses.log");
        header("Location: ../../erreur/erreur.php?erreur=connexionImpossible");
    }

    // Requête pour récupérer l'utilisateur
    $requeteRecupererUtilisateur = new SelectUtilisateur($courriel);
    $utilisateur = $requeteRecupererUtilisateur->select();

    // Vérifier si l'utilisateur existe
    if (isset($utilisateur)){
        // Vérifier si le mot de passe correspond à l'utilisateur
        if (password_verify($mdp, $utilisateur->getMdp())){
            CreerSession2FA($utilisateur->getNomUtilisateur(), $courriel, $utilisateur->getId());
            header("Location: ../../connexion/2FA.php");
        }
        else{
            // Il n'a pas le bon mot de passe
            header("Location: /storeconfig/connexion/index.php?erreur=informationErrone"); // "Courriel ou mot de passe erroné"
        }
    }
    else{
        // Il n'a pas le bon courriel (Utilisateur n'existe pas)
        header("Location: /storeconfig/connexion/index.php?erreur=informationErrone"); // "Courriel ou mot de passe erroné"
    }

    

}
else{
    // Si je n'ai pas  le courriel ou le mot de passe 
    error_log("[".date("d/m/o H:i:s e",time())."] Authentification anormal - nom d'utilisateur, mail ou mdp absent: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/acces-refuses.log");
    header("Location: ../../erreur/erreur.php?erreur=connexionImpossible");
}

?>