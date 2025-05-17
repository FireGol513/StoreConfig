<?php

include_once __DIR__."/../service/session/SessionFinale.include.php";
require_once __DIR__."/../service/db/repository/Select/SelectReseau.classe.php";


$sessionConnecte = new SessionFinale();
session_start();
$sessionConnecte->validerSession();


if (!empty($_GET["erreur"])){

    $affichageErreur = "";
    $erreur = filter_input(INPUT_GET, "erreur", FILTER_DEFAULT);

    if ($erreur == "reseauIntrouvable"){
        $affichageErreur = "Réseau introuvable";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau de contrôle - StoreConfig</title>
    <link rel="stylesheet" href="../css/style.css">
    
    <!--- Script pour les formulaires / menus-->
    <script src="/storeconfig/js/menu.js"></script>
    <script src="/storeconfig/js/reseaux.js"></script>

    <!--- Font personnalisé-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aldrich&display=swap" rel="stylesheet">
    
</head>
<body class="bodyNonPlein">
    <header>
        <nav>
            <ul>
                <li><a href="/storeconfig/panneauConfig/">StoreConfig Control Panel</a></li>
                <li><a href="/storeconfig/">Quitter</a></li>
            </ul>
        </nav>
    </header>


    <!-- Information sur les erreurs du panneau de config-->
    <div>
        <h1 id="titre">Erreur</h1>
        
        <article>
            <section id="slogan">
                    <b><? if ($affichageErreur){echo $affichageErreur;}?></b>
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