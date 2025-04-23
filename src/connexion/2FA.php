<?php

// Ce fichier permet de se connecter avec la 2FA


function envoyerMail($to, $message) {
    $subject = 'Code de vérification';
    $headers = 
    'From: perronh25techinf@perron.h25.techinfo420.ca' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
    return mail($to, $subject, $message, $headers);
}


// Reprendre la session de 2FA

require_once __DIR__."/../service/session/Session2FA.include.php";

$session2FA = new Session2FA();
session_start();
$session2FA->validerSession();

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