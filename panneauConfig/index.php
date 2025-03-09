<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau de contrôle - StoreConfig</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/blocReseaux.css">
    <script src=/storeconfig/js/panneau.js></script>
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


    <?php
    # Il va falloir la base de données pour récupérer les réseaux par utilisateurs
    $nom_reseaux = 10;
    for ($i=0; $i < $nom_reseaux; $i++) { 
        echo 
        '<article id="reseau_div_'.$i.'">
            <h3>Nom Réseaux '.$i.'</h3>
            <form action="reseau.php" name="RéseauxAction" method="get">
                <img src="https://automationcommunity.com/wp-content/uploads/2023/01/Tree-Network-Topology.jpg" alt="Image du réseaux">
                <fieldset>
                    <input type="submit" name="reseau'.$i.'" value="Voir"><br />
                    <input type="submit" name="reseau'.$i.'" value="Modifier"><br />
                    <input type="button" onclick="VerificationSupression(reseau_div_'.$i.')" value="Supprimer" id="SupprimerRéseaux'.$i.'">
                </fieldset>
            </form>
        </article>';
    }
    ?>
</body>
</html>