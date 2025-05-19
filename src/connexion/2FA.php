<?php

// Ce fichier permet de se connecter avec la 2FA


function envoyerMail($to, $message) {
    $subject = 'Code de vérification';
    $headers = 
    'From: perronh25techinf@perron.h25.techinfo420.ca' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
    return mail($to, $subject, $message, $headers);
}


$messageErreur = "";
if (!empty($_GET["erreur"])){

    $erreur = filter_input(INPUT_GET, "erreur", FILTER_DEFAULT);

    if ($erreur){

        switch ($erreur){
            case "mailNonEnvoyer":
                $messageErreur = "Courriel ne s'est pas envoyer correctement";
                break;
            
            case "mauvaisCode":
                $messageErreur = "Mauvais code. Un nouveau code vous a été envoyé.";
                break;
        }

    }

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
    
        error_log("[".date("d/m/o H:i:s e",time())."] 2FA impossible. Nous ne pouvons pas envoyer un courriel pour la 2FA: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/acces-refuses.log");
        header("Location: .?erreur=mailNonEnvoyer");
        exit();
    }

    // Garder le code dans la session
    $_SESSION["code"] = $code;
    
}
else{
    error_log("[".date("d/m/o H:i:s e",time())."] 2FA impossible. L'utilisateur n'ai pas authentifié: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/acces-refuses.log");
    header("Location: ../erreur/erreur.php?erreur=connexionImpossible");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <link rel="stylesheet" href="/storeconfig/css/style.css">

    <!--- Font personnalisé-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aldrich&display=swap" rel="stylesheet">


</head>
<body class="bodyNonPlein">
    
    <!-- Barre de Navigation -->
    <header>
        <nav>
            <ul>
                <li><a href="/storeconfig/">StoreConfig</a></li>
            </ul>
        </nav>
    </header>

    <div>
        <h1 id="titre">Connexion 2FA</h1>
        <form class="formConnexion" action="../service/connexionRedirect/2FA.redirect.php" method="POST">
            <?php
                if ($messageErreur != ""){
                    echo '<label style="color: red; text-decoration: underline;" for="mauvaiseDonnees">'.$messageErreur.'</label>';
                }
            ?>
            <label for="Code">
                Code:
                <input type="number" name="Code2FA" id="Code2FA">
            </label>
            <input type="submit" value="Envoyer le code">
        </form>
    </div>


    <!-- Pied de la page qui contient les informations pour me rejoindre et la repo GitHub -->
    <footer>
            <h2>Vous voulez me contacter?</h2>
            <a href="mailto:firegold513@gmail.com"><img src="/storeconfig/images/Footer/icons8-email-96.png" alt="Contacter par Email" height="50px" width="50px"/></a>
            <a href="https://github.com/FireGol513/StoreConfig" target="top"> <img src="/storeconfig/images/Footer/github.png" alt="Github Repo" height="50px" width="50px"/></a>
    </footer>



</body>
</html>
