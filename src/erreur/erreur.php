<?php

require_once $_SERVER['DOCUMENT_ROOT']."/storeconfig/service/session/SessionFinale.include.php";

$sessionConnecte = new SessionFinale();
session_start();


$affichageErreur = "";
if (isset($_GET["erreur"])){

    $erreur = filter_input(INPUT_GET, "erreur", FILTER_DEFAULT);

    switch ($erreur){
        case "nonAuth":
            $affichageErreur = "Vous devez être authentifié pour voir cette page";
            break;

        case "creationUtilisateur":
            $affichageErreur = "Création de compte impossible";
            break;

        case "connexionImpossible":
            $affichageErreur = "Connexion impossible";
            break;

        case "delaiDepasse":
            $affichageErreur = "Délai de connexion dépassé";
            break;

        default:
            $affichageErreur = "Vous avez une erreur";
    }
        
    
}else{
    $affichageErreur = "Vous avez une erreur";
}

?>

<!-- Affichage des erreurs -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/storeconfig/css/style.css">

    <title>StoreConfig</title>

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
                <li><a href="/storeconfig/mesProduits.php">Mes produits</a></li>
                <li><a href="/storeconfig/nosProduits.php">Nos produits</a></li>
                <li><a href="/storeconfig/index.php">StoreConfig</a></li>
                <li><a href="/storeconfig/support.php">Support</a></li>
                <li>
                    <? if(isset($_SESSION["nomUtilisateur"])){
                            echo "<a href='service/connexionRedirect/deconnexion.redirect.php'>".$_SESSION["nomUtilisateur"]."<br /> Déconnexion"; // TEMP (Doit etre changer!!!!)
                        }
                        else{
                            echo "<a href='/storeconfig/connexion/'>"."Connexion";
                        }
                    ?>
                </a></li>
            </ul>
        </nav>
    </header>


    <!-- Information sur les erreurs -->
    <div>
        <h1 id="titre">Erreur</h1>
        
        <article>
            <section id="slogan">
                    <b><? echo $affichageErreur;?></b>
            </section>
        </article>
    </div>
    


    <!-- Pied de la page qui contient les informations pour me rejoindre et la repo GitHub -->
    <footer>
        <h2>Vous voulez me contacter?</h2>
        <a href="mailto:firegold513@gmail.com"><img src="/storeconfig/images/Footer/icons8-email-96.png" alt="Contacter par Email" height="50px" width="50px"/></a>
        <a href="https://github.com/FireGol513/StoreConfig" target="top"> <img src="/storeconfig/images/Footer/github.png" alt="Github Repo" height="50px" width="50px"/></a>
    </footer>

</body>
</html>


