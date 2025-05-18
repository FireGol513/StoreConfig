<?php

    include_once __DIR__."/../service/session/SessionFinale.include.php";
    require_once __DIR__."/../service/db/repository/Select/SelectInterface.classe.php";
    require_once __DIR__."/../service/db/repository/Select/SelectMachine.classe.php";


    $sessionConnecte = new SessionFinale();
    session_start();
    $sessionConnecte->validerSession();
    

    // Action que l'on est en train de faire (0 = rien, 1 = voir, 2 = modifier)
    $action = 0; 
    if (!empty($_GET['voir'])){

        $idMachine = filter_input(INPUT_GET, "voir", FILTER_VALIDATE_INT);

        if ($idMachine){

            $action = 1;
            
        }
        else{
           header("Location: /storeconfig/erreur/erreurPanneauConfig.php?erreur=reseauIntrouvable");
        }

    }
    else if (!empty($_GET['modifier'])){

        $idMachine = filter_input(INPUT_GET, "modifier", FILTER_VALIDATE_INT);

        if ($idMachine){

            $action = 2;
            
        }
        else{
           header("Location: /storeconfig/erreur/erreurPanneauConfig.php?erreur=reseauIntrouvable");
        }

    }
    else{
        // Pas d'erreur. Je rapporte seulement à la liste des réseaux
        header("Location: /storeconfig/panneauConfig/");
        die();
    }

    $selectMachine = new SelectMachine(0);
    $machine = $selectMachine->select($idMachine);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/blocReseaux.css">
    <link rel="stylesheet" href="../css/interface.css">

    <!--- Font personnalisé-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aldrich&display=swap" rel="stylesheet">

    <!--- Script pour les formulaires / menus-->
    <script src="/storeconfig/js/machines.js"></script>
    <script src="/storeconfig/js/menu.js"></script>
</head>
<body class=bodyDoomScroll>
    <header>
        <nav>
            <ul>
                <li><a href=".">StoreConfig Control Panel</a></li>
                <!--- Pour quitter, il faudra se déconnecter?-->
                <li><a href="../index.php">Quitter</a></li>
            </ul>
        </nav>
    </header>

    <h1 id="titre"><?=$machine->getNomMachine()?></h1>
    
    <h2 id="slogan"><?=$machine->getModele()?></h2>

    <div class=conteneurInterfaceEtBouton>
        <!-- Affichage de toutes les machines dans le réseau sélectionné-->
        <?php

            // Bouton pour ajouter ou supprimer des machines
            
            if(($action == 2)){
                echo '<div class="conteneurBouton">';
                echo '<button class="buttonMachine" onclick="afficherMenuCreationMachine()"><img src="/storeconfig/images/Creation/plus-icon.png" alt="Ajouter"></button>';
                echo '<button class="buttonMachine" onclick="afficherCheckboxSupprimer(this)"><img src="/storeconfig/images/Creation/minus-icon.png" alt="Supprimer"></button>';
                echo '</div>';
            }

            // Interfaces

            $selectInterface = new SelectInterface($machine->getId());
            $interfaces = $selectInterface->selectMultiple();

            echo '<div class="conteneurInterface">';
            foreach ($interfaces as $numInterface => $interface) { 
                echo 
                '<article class="machine" style="width: 20%; margin: 3em;">
                <label for="NomInterface"> Nom de l\'interface
                <h5>'.$interface->getNom().'</h5>
                </label>
                <label for="Type"> Type d\'interface
                <h5>'.$interface->getIdType().'</h5>
                </label> 
                <label for="AdresseMAC"> Adresse MAC
                <h5>'.$interface->getAddressMAC().'</h5>
                </label> 
                <label for="AdresseIP"> Adresse IP + CIDR
                <h5>'.$interface->getAddressIP().'/'.$interface->getCidr().'</h5>
                </label> 
                <label for="Paserelle"> Paserelle par défaut
                <h5>'.$interface->getPaserelle().'</h5>
                </label> 
                <label for="Commentaires"> Commentaires
                <h5>'.$interface->getCommentaires().'</h5>
                </label> 
                </article>';
            }
            echo '</div>';
            
            


            
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
