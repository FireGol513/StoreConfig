<?php

# Ce fichier permet la connexion au utilisateur déjà existant dans la base de données

?>
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