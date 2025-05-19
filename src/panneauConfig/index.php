<?php

include_once __DIR__."/../service/session/SessionFinale.include.php";
require_once __DIR__."/../service/db/repository/Select/SelectReseau.classe.php";


$sessionConnecte = new SessionFinale();
session_start();
$sessionConnecte->validerSession();


if (!empty($_GET["erreur"])){

    $afficherErreur = "";
    $erreur = filter_input(INPUT_GET, "erreur", FILTER_DEFAULT);

    if ($erreur == "nomReseau"){
        $afficherErreur = "Impossible de créer le réseau dû au nom qu'il lui a été donné";
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
    <link rel="stylesheet" href="../css/blocReseaux.css">
    
    <!--- Script pour les formulaires / menus-->
    <script src="/storeconfig/js/menu.js"></script>
    <script src="/storeconfig/js/reseaux.js"></script>

    <!--- Font personnalisé-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aldrich&display=swap" rel="stylesheet">
    
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href=".">StoreConfig Control Panel</a></li>
                <li><a href="../index.php">Quitter</a></li>
            </ul>
        </nav>
    </header>


    <h1 id="titre">Vos réseaux</h1>
    <?php
    if ($afficherErreur != ""){
       echo '<h2 id="slogan">'.$afficherErreur.'</h2>';
    }

    ?>
    <div class="conteneurBouton">

    <button class="buttonMachine" onclick="creerNouveauReseau()"><img src="/storeconfig/images/Creation/plus-icon.png" alt="Ajouter"></button>

    </div>
        <?php
        # Il va falloir la base de données pour récupérer les réseaux par utilisateurs
        
        $selectReseau = new SelectReseau($_SESSION["idUtilisateur"]);
        $reseaux = $selectReseau->selectMultiple();
        
        foreach ($reseaux as $numReseau => $reseau) {
            echo 
            '<article id="reseau_div_'.$numReseau.'">
                <h3>'.$reseau->getNomReseau().'</h3>
                <form action="machines.php" name="RéseauxAction" method="get">
                    <img src="/storeconfig/images/Reseaux/Tree-Network-Topology.jpg" alt="Image du réseaux">
                    <fieldset>
                        <button name="voir" value="'.$reseau->getId().'">Voir</button><br />
                        <button name="modifier" value="'.$reseau->getId().'">Modifier</button><br />
                        <input type="button" onclick="verificationSupression(reseau_div_'.$numReseau.','.$reseau->getId().')" value="Supprimer" id="SupprimerRéseaux'.$numReseau.'">
                    </fieldset>
                </form>
            </article>';
        }
        ?>
    </div>

    <!-- Pied de la page qui contient les informations pour me rejoindre et la repo GitHub -->
    <footer>
        <h2>Vous voulez me contacter?</h2>
        <a href="mailto:firegold513@gmail.com"><img src="/storeconfig/images/Footer/icons8-email-96.png" alt="Contacter par Email" height="50px" width="50px"/></a>
        <a href="https://github.com/FireGol513/StoreConfig" target="top"> <img src="/storeconfig/images/Footer/github.png" alt="Github Repo" height="50px" width="50px"/></a>
    </footer>

    
    
</body>
</html>