<?php


# Ce fichier permet la connexion au utilisateur déjà existant dans la base de données
session_start();

if (session_name() == "ConnecteFinal"){
    header("Location: /storeconfig");
}
elseif (session_name() == "2FA"){
    header("Location: ./2FA.php");
}

session_destroy();

if (isset($_SESSION[''])){

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
<body>
    
    <!-- Barre de Navigation -->
    <header>
        <nav>
            <ul>
                <li><a href="/storeconfig/">StoreConfig</a></li>
            </ul>
        </nav>
    </header>

    <div>
        <h1>Connexion</h1>

        <form action="../service/connexionRedirect/auth.redirect.php" method="post">
            <label for="Email">
                Adresse de courriel:
                <input type="email" name="courriel" id="courriel">
            </label>
            <br>
            <label for="MotDePasse">
                Mot de passe:
                <input type="password" name="mdp" id="mdp">
            </label>
            <br>
            <input type="submit" value="Se connecter">

        </form>

        <a href="creerCompte.php">Pas de compte? Créé le!</a>
    </div>


    <!-- Pied de la page qui contient les informations pour me rejoindre et la repo GitHub -->
    <footer>
            <h2>Vous voulez me contacter?</h2>
            <a href="mailto:firegold513@gmail.com"><img src="/storeconfig/images/Footer/icons8-email-96.png" alt="Contacter par Email" height="50px" width="50px"/></a>
            <a href="https://github.com/FireGol513/StoreConfig" target="top"> <img src="/storeconfig/images/Footer/github.png" alt="Github Repo" height="50px" width="50px"/></a>
    </footer>



</body>
</html>

