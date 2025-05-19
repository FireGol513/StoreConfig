<?php


# Ce fichier permet la connexion au utilisateur déjà existant dans la base de donnée


# Changer de page si j'ai des sessions actives de connexion ou de 2FA


// echo session_name();
// echo $_SESSION;
// if (session_name() == "ConnecteFinal"){
//     header("Location: /storeconfig");
//     die();
// }
// elseif (session_name() == "2FA"){
//     header("Location: ./2FA.php");
//     die();
// }

$messageErreur = "";
if (!empty($_GET["erreur"])){

    $erreur = filter_input(INPUT_GET, "erreur", FILTER_DEFAULT);

    if ($erreur){

        switch ($erreur){
            case "informationErrone":
                $messageErreur = "Courriel ou mot de passe erroné";
                break;
        }

    }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StoreConfig - Connexion</title>

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
        <h1 id="titre">Connexion</h1>

        <form class="formConnexion" action="../service/connexionRedirect/auth.redirect.php" method="post">
            
            <?php
                if ($messageErreur != ""){
                    echo '<label style="color: red; text-decoration: underline;" for="mauvaiseDonnees">'.$messageErreur.'</label>';
                }
            ?>
            <label for="Email">
                Adresse de courriel:
                <input type="email" name="courriel" id="courriel" required>
            </label>
            <br>
            <label for="MotDePasse">
                Mot de passe:
                <input type="password" name="mdp" id="mdp" required>
            </label>
            <br>
            <input type="submit" value="Se connecter">
            <br>
            <a href="creerCompte.php">Pas de compte? <br> Créé le!</a>
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

