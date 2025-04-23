<?php

require_once "../db/repository/Select/SelectUtilisateur.classe.php";


// function CreerSession2FA() {
//     session_start();
// }




if (!empty($_POST['courriel']) and !empty($_POST['mdp'])){

    $courriel = filter_input(INPUT_POST, "courriel", FILTER_VALIDATE_EMAIL);
    $mdp = filter_input(INPUT_POST, "mdp", FILTER_DEFAULT);

    if (empty($courriel)){
        error_log("[".date("d/m/o H:i:s e",time())."] Authentification anormal - mail n'a pas la forme demandé: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/storeconfig.acces.log");
        header("Location: ../../erreur/erreur.php");
    }

    // Requête pour récupérer l'utilisateur
    $requeteRecupererUtilisateur = new SelectUtilisateur($courriel);
    $utilisateur = $requeteRecupererUtilisateur->select();

    // Vérifier si l'utilisateur existe
    if (isset($utilisateur)){
        // Vérifier si le mot de passe correspond à l'utilisateur
        if (password_verify($mdp, $utilisateur->getMdp())){
            echo "TEMP_CONNECTE";
        }
        else{
            // Il n'a pas le bon mot de passe
            echo "Courriel ou mot de passe erroné";
        }
    }
    else{
        // Il n'a pas le bon courriel (Utilisateur n'existe pas)
        echo "Courriel ou mot de passe erroné";
    }

    

}
else{
    // Si je n'ai pas  le courriel ou le mot de passe 
    error_log("[".date("d/m/o H:i:s e",time())."] Authentification anormal - nom d'utilisateur, mail ou mdp absent: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/storeconfig.acces.log");
    header("Location: ../../erreur/erreur.php");
}

?>