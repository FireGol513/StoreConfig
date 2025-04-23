<?php

# Ce fichier permet de créer un compte dans la base de données

?>
<h1>Créer un compte</h1>

<form action="../service/connexionRedirect/creerCompte.redirect.php" method="post">
    <label for="NomUtilisateur">
        Nom d'utilisateur:
        <input type="text" name="nomUtilisateur" id="nomUtilisateur">
    </label>
    <br>
    <label for="Email">
        Adresse courriel:
        <input type="email" name="courriel" id="courriel">
    </label>
    <br>
    <label for="MotDePasse">
        Mot de passe:
        <input type="password" name="mdp" id="mdp">
    </label>
    <br>
    <input type="submit" value="Créer un compte">
</form>