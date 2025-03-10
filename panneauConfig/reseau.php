<?php
    
    class Reseau {
        public $numero;
        public $nom;
        public $machines;
    }


    function ActionVoir() : bool {
        global $action;
        return $action == "Voir";
    }
    

    function ActionModifier() : bool {
        global $action;
        return $action == "Modifier";
    }

    // function ActionSupprimer() : Returntype {
        
    // }
    
    
    
    
    # Je devrai vérifier quelles sont les réseaux possibles de vérifier le contenu
    # Le array contiendrait les numéros des réseaux?
    $liste_num_reseaux = array(0,1,2,3,4,5,7,8,9);


    # Action que l'on veut faire sur le réseaux
    $action = "";

    # Récupérer le bon numéro de réseau
    foreach ($liste_num_reseaux as $num_reseau) {
        $action_request=filter_input(INPUT_GET,"reseau".$num_reseau);
        if (!is_null($action_request)){
            $action = $action_request;
            break;
        }
    }

    # Créer le réseau qu'on travaille avec
    $reseau = new Reseau();
    $reseau->nom = "Test réseau";


    # Récupérer toutes les numéros des machines (BD)
    $liste_machine = array(0,1,2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/blocReseaux.css">
    <script src="/storeconfig/js/reseau.js"></script>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href=".">StoreConfig Control Panel</a></li>
                <!--- Pour quitter, il faudra se déconnecter?-->
                <li><a href="../index.html">Quitter</a></li>
            </ul>
        </nav>
    </header>

    <h1 class="titreReseau">Réseau <?= $reseau->nom?></h1>
    

        <!-- Affichage de toutes les machines dans le réseau sélectionné-->
        <?php
            echo '<div class="conteneurBouton">';
            if(ActionModifier()){
                echo '<button class="buttonMachine" onclick="afficherMenuCreationMachine()"><img src="/storeconfig/images/Creation/plus-icon.png" alt="Ajouter"></button>';
                echo '<button class="buttonMachine" onclick="afficherCheckboxSupprimer()"><img src="/storeconfig/images/Creation/minus-icon.png" alt="Supprimer"></button>';
            }
            echo '</div>';

            for ($i=0; $i < 20; $i++) { 
                echo 
                '<article class="machine">
                    <h5>Machine '.$action.'</h5>
                </article>';
            }
        ?>
    
</body>
</html>