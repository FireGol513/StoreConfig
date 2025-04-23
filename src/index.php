<?php

require_once __DIR__."/service/session/SessionFinale.include.php";


$sessionConnecte = new SessionFinale();
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    <title>StoreConfig</title>
</head>
<body>

    <!-- Barre de Navigation -->
    <header>
        <nav>
            <ul>
                <li><a href="mesProduits.html">Mes produits</a></li>
                <li><a href="nosProduits.html">Nos produits</a></li>
                <li><a href="index.php">StoreConfig</a></li>
                <li><a href="support.html">Support</a></li>
                <li>
                    <? if(isset($_SESSION["nomUtilisateur"])){
                            echo "<a href='service/connexionRedirect/deconnexion.redirect.php'>".$_SESSION["nomUtilisateur"]; // TEMP (Doit etre changer!!!!)
                        }
                        else{
                            echo "<a href='connexion/'>"."Connexion";
                        }
                    ?>
                </a></li>
            </ul>
        </nav>
    </header>

    <!-- Information sur les nouveautés du site et nos produits en général -->
    <article>
        <h1>Page d'Accueil</h1>
        <p>
            Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum mi tristique lobortis, eget bibendum magnis erat. Et donec class, finibus volutpat fusce fringilla. Hendrerit donec orci consectetur egestas convallis nisl litora nec. Dictum feugiat porttitor aenean mollis orci aptent etiam. Ante etiam laoreet sagittis velit efficitur. Ac nec non tempus cras eros dui. Tincidunt eros ligula conubia dictumst himenaeos nisl sem mollis. Mauris nunc eget orci habitant tincidunt et curabitur et semper.

Interdum auctor elit mollis dignissim eleifend cras. Ultricies non orci aliquet, justo sagittis consequat amet. Cubilia nisl metus eleifend morbi convallis ipsum aliquam. Aliquam aenean nisl in integer sollicitudin nostra adipiscing eleifend. Nunc scelerisque dolor integer facilisi risus urna. Elit vivamus consectetur iaculis fusce vivamus velit. Platea pulvinar at vitae efficitur habitant eu adipiscing. Pretium nulla nullam tellus ad commodo ad.

Tempus curae proin bibendum commodo non justo lectus suscipit. Aliquam etiam consequat, tristique efficitur a pharetra risus. Arcu euismod morbi commodo nibh vestibulum nullam vivamus nostra. Vehicula non vehicula massa placerat porttitor lacus. Penatibus nascetur lacus scelerisque potenti sollicitudin risus semper vulputate purus. Duis eros ligula pellentesque velit erat. Est malesuada aliquet massa ad consequat justo efficitur.

Vulputate velit quisque tellus semper urna, aliquam himenaeos. Vestibulum bibendum blandit dui porttitor; massa ad. Fusce vitae in sollicitudin curabitur nunc primis cubilia adipiscing. Orci parturient bibendum natoque lectus auctor dolor a elit. Taciti ullamcorper aptent nulla ullamcorper vel consequat. Tristique tempor scelerisque, volutpat montes imperdiet lacinia iaculis. Felis euismod mattis sed ultricies varius pulvinar. Amet aliquet pharetra non porta suspendisse mauris cras faucibus metus.

Himenaeos vestibulum nostra rhoncus ad curabitur. Parturient varius vel maximus dui pharetra per. Ligula aenean maecenas sit nam mattis sed montes. Taciti sapien scelerisque justo ultrices neque et. Molestie donec eros dignissim ultricies maximus porttitor est cursus. Id lectus ante mattis aptent amet risus sit ante. Feugiat nunc parturient mattis lobortis hendrerit natoque velit ullamcorper. Vel cras donec; duis consequat euismod dapibus.

Dignissim mi vehicula tempor blandit phasellus dictumst dignissim massa. Nullam curabitur blandit montes donec vel; molestie magnis. Ad dolor himenaeos facilisi litora aliquet aliquet. Per sit enim ad; tempor in consectetur in mauris integer. Sociosqu hendrerit phasellus fames vehicula aliquet; parturient feugiat maecenas eget. Facilisi tortor lobortis nunc leo eros rhoncus vulputate metus odio. Himenaeos dapibus phasellus nulla metus congue hac elit. Fringilla sapien habitant senectus at eu consequat augue. Ligula iaculis mattis natoque pharetra montes nunc natoque euismod.

Imperdiet maximus nascetur habitasse nascetur; scelerisque proin egestas condimentum. In vitae rhoncus dictum imperdiet nisi sodales finibus sed. Augue sagittis mattis tristique dictum per dis pretium phasellus. Enim libero efficitur quisque, netus conubia egestas. Magnis praesent purus pellentesque mattis dolor. Euismod dictum egestas purus pellentesque ultrices pellentesque pellentesque?

Consectetur vehicula quisque nec dictumst semper maecenas. Amet tellus egestas ridiculus nec taciti. Porta facilisis feugiat ipsum; finibus class dapibus. Mollis sed malesuada arcu cursus aptent ut class finibus. Quisque cursus fermentum eget et interdum hac nec tincidunt? Aliquam a adipiscing nisi metus dis quam. Lacinia leo facilisi cubilia urna convallis. Montes finibus litora molestie aliquet nullam?

Amet neque malesuada orci; scelerisque potenti luctus litora pretium pretium. Litora platea felis cubilia nullam, efficitur habitasse conubia libero. Diam iaculis rutrum nullam venenatis suscipit interdum sem. Praesent nam finibus magna, curabitur primis proin magna nascetur. Ipsum nec netus platea sit justo ridiculus hac semper? Purus nam rutrum aliquet accumsan; egestas dapibus faucibus. Scelerisque feugiat turpis nibh cursus ligula tempus imperdiet conubia. Fames aenean non diam cubilia justo elit.

Iaculis metus fames, ultrices facilisis class fames. Ac egestas penatibus vestibulum vestibulum nisl hendrerit. Amet est dolor tellus lacus commodo ornare tempor ultrices. Taciti cursus senectus scelerisque vulputate imperdiet ut curabitur curabitur. Ac ac arcu posuere neque hac vitae rhoncus. Conubia cubilia odio sit tincidunt magna.
        </p>
    </article>

    <!-- Pied de la page qui contient les informations pour me rejoindre et la repo GitHub -->
    <footer>
        <h2>Vous voulez me contacter?</h2>
        <a href="mailto:firegold513@gmail.com"><img src="images/Footer/icons8-email-96.png" alt="Contacter par Email" height="50px" width="50px"/></a>
        <a href="https://github.com/FireGol513/StoreConfig" target="top"> <img src="images/Footer/github.png" alt="Github Repo" height="50px" width="50px"/></a>
    </footer>

</body>
</html>