<?php

include_once __DIR__."/service/session/SessionFinale.include.php";


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
                <li><a href="mesProduits.php">Mes produits</a></li>
                <li><a href="nosProduits.php">Nos produits</a></li>
                <li><a href="index.php">StoreConfig</a></li>
                <li><a href="support.php">Support</a></li>
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

    <!-- Information sur les nouveautés du site et nos produits en général -->
    <h1 id="titre">StoreConfig</h1>
    
    <article>
        <section id="slogan">
                <b>Des configurations réseaux plus dynamiques qu'un fichier Excel !</b>
        </section>
    </article>
    
    <article class="articleInformation">
        <section class="sectionArticleInfoText">
            <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce placerat lectus at odio mattis porttitor. 
            Proin bibendum felis ac augue imperdiet vestibulum. Donec non felis eget erat rhoncus congue in sed lacus. 
            Ut bibendum nisl ac neque euismod varius. Morbi at turpis vel ante molestie ullamcorper. 
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce placerat lectus at odio mattis porttitor. 
            Proin bibendum felis ac augue imperdiet vestibulum. Donec non felis eget erat rhoncus congue in sed lacus. 
            Ut bibendum nisl ac neque euismod varius. Morbi at turpis vel ante molestie ullamcorper. 
            </p>
        </section>
        
        <section class="sectionArticleInfoImg">
            <img src=/storeconfig/images/ArticleExplication/reseau-cartoon.jpeg alt="">
        </section>
    </article>
    <article class="articleInformation">
        <section class="sectionArticleInfoImg">
            <img src=/storeconfig/images/ArticleExplication/technicien-reseaux.jpg alt="">
        </section>

        <section class="sectionArticleInfoText">
            <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce placerat lectus at odio mattis porttitor. 
            Proin bibendum felis ac augue imperdiet vestibulum. Donec non felis eget erat rhoncus congue in sed lacus. 
            Ut bibendum nisl ac neque euismod varius. Morbi at turpis vel ante molestie ullamcorper.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce placerat lectus at odio mattis porttitor. 
            Proin bibendum felis ac augue imperdiet vestibulum. Donec non felis eget erat rhoncus congue in sed lacus. 
            Ut bibendum nisl ac neque euismod varius. Morbi at turpis vel ante molestie ullamcorper. 
            </p>
        </section>
    </article>

    <!-- Pied de la page qui contient les informations pour me rejoindre et la repo GitHub -->
    <footer>
        <h2>Vous voulez me contacter?</h2>
        <a href="mailto:firegold513@gmail.com"><img src="images/Footer/icons8-email-96.png" alt="Contacter par Email" height="50px" width="50px"/></a>
        <a href="https://github.com/FireGol513/StoreConfig" target="top"> <img src="images/Footer/github.png" alt="Github Repo" height="50px" width="50px"/></a>
    </footer>

</body>
</html>