<?php

# Ce fichier permet de créer un compte dans la base de données

$messageErreur = "";
if (!empty($_GET["erreur"])){

    $erreur = filter_input(INPUT_GET, "erreur", FILTER_DEFAULT);

    if ($erreur){

        switch ($erreur){
            case "courrielDejaExistant":
                $messageErreur = "Compte avec ses informations déjà existant";
                
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
                <li><a href="/storeconfig/connexion/"> Connexion</a></li>
            </ul>
        </nav>
    </header>

    <div>
        <h1 id="titre">Créer un compte</h1>

        <form class="formConnexion" action="../service/connexionRedirect/creerCompte.redirect.php" method="post">
            
            <?php
                if ($messageErreur != ""){
                    echo '<label style="color: red; text-decoration: underline;" for="mauvaiseDonnees">'.$messageErreur.'</label>';
                }
            ?>
            <label for="NomUtilisateur">
                Nom d'utilisateur:
                <input type="text" name="nomUtilisateur" id="nomUtilisateur" required>
            </label>
            <br>
            <label for="Email">
                Adresse courriel:
                <input type="email" name="courriel" id="courriel" required>
            </label>
            <br>
            <label for="MotDePasse">
                Mot de passe:
                <input type="password" name="mdp" id="mdp" required>
            </label>
            <br>
            <input type="submit" value="Créer un compte">
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
