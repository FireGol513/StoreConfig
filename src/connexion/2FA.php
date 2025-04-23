<?php

// Ce fichier permet de se connecter avec la 2FA


function envoyerMail($to, $message) {
    $subject = 'Code de vérification';
    $headers = 
    'From: perronh25techinf@perron.h25.techinfo420.ca' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
    return mail($to, $subject, $message, $headers);
}

function ReprendreSession2FA(){
    define("DUREE_SESSION",60*15);//Utilisée pour le cookie et timestamp. (15min)
                
    ini_set("session.cookie_lifetime", DUREE_SESSION); // Durée de la session en secondes
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

if (isset($_SESSION["courriel"]) && isset($_SESSION["nomUtilisateur"])){
    $courriel = $_SESSION["courriel"];

    // Envoyer un mail pour la 2FA
    $code = rand(100000,999999);


    if (!envoyerMail($courriel, "Votre code est : ".$code)) {
    
        error_log("[".date("d/m/o H:i:s e",time())."] 2FA impossible. Nous ne pouvons pas envoyer un courriel pour la 2FA: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/storeconfig.acces.log");
        header("Location: ../erreur/erreur.php");
        exit();
    }

    // Garder le code dans la session
    $_SESSION["code"] = $code;
    
}
else{
    error_log("[".date("d/m/o H:i:s e",time())."] 2FA impossible. L'utilisateur n'ai pas authentifié: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/storeconfig.acces.log");
    header("Location: ../erreur/erreur.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion 2FA</title>
</head>
<body>
    <h1>Connexion 2FA</h1>
    <form action="../service/connexionRedirect/2FA.redirect.php" method="POST">
        <label for="Code">
            Code:
            <input type="number" name="Code2FA" id="Code2FA">
        </label>
        <input type="submit" value="Envoyer le code">
    </form>
</body>
</html>