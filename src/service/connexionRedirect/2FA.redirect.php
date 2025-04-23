<?php


function CreerSessionConnecte(string $nomUtilisateur){
    define("DUREE_SESSION",60*120);//Utilisée pour le cookie et timestamp. (2h)
                
    ini_set("session.cookie_lifetime", DUREE_SESSION); // Durée de la session en secondes
    ini_set("session.use_cookies", 1);
    ini_set("session.use_only_cookies" , 1);
    ini_set("session.use_strict_mode", 1);
    ini_set("session.cookie_httponly", 1);
    ini_set("session.cookie_secure", 1);
    ini_set("session.cookie_samesite" , "Strict");
    ini_set("session.cache_limiter" , "nocache");
    ini_set("session.hash_function" , "sha512");


    session_name("Connecte"); //C'est la session de l'utilisateur connecte

    session_start();

    // Mettre les paramètres de session
    $_SESSION["ip"] = $_SERVER["REMOTE_ADDR"];
    $_SESSION["nomUtilisateur"] = $nomUtilisateur;
    $_SESSION["hote"] = $_SERVER["REMOTE_USER"];

    header("Location: ../../index.php");
}

function ReprendreSession2FA(){
    ini_set("session.cookie_lifetime", 60*15); // Durée de la session en secondes
    ini_set("session.use_cookies", 1);
    ini_set("session.use_only_cookies" , 1);
    ini_set("session.use_strict_mode", 1);
    ini_set("session.cookie_httponly", 1);
    ini_set("session.cookie_secure", 1);
    ini_set("session.cookie_samesite" , "Strict");
    ini_set("session.cache_limiter" , "nocache");
    ini_set("session.hash_function" , "sha512");


    session_name("2FA"); //C'est la session pour la 2FA

    session_start();
}

ReprendreSession2FA();

if (isset($_POST["Code2FA"]) && isset($_SESSION["code"]) && isset($_SESSION["courriel"]) && isset($_SESSION["nomUtilisateur"])){
    
    $code2FA = filter_input(INPUT_POST, "Code2FA", FILTER_VALIDATE_INT);
    $nomUtilisateur = $_SESSION["nomUtilisateur"];

    if (!isset($code2FA)){
        error_log("[".date("d/m/o H:i:s e",time())."] 2FA impossible. Le code de 2FA n'ai pas numérique: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/storeconfig.acces.log");
        header("Location: ../../erreur/erreur.php");
        exit();
    }

    if ($code2FA == $_SESSION["code"]){
        session_destroy();
        CreerSessionConnecte($nomUtilisateur);

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