<?php
function RedirigerAuth($courriel, $mdp) {
    
    header("Location: ../../connexion/index.php");
    
    // TODO: Eventuellement si j'ai le temps
    // // Attributs
    // $destination = "./auth.redirect.php";
    
    // // Création du header de la requête POST
    // $options = [
    //     "http" => [
    //         'method' => 'POST',
    //         'header' => 'Location: '.$destination,
    //         'content' => http_build_query(["courriel" => $courriel, "mdp" => $mdp])
    //     ]
    // ];

    // // Création de la requete POST
    // $requetePost = stream_context_create($options);

    // // Envoyer la requête
    // $reponse = file_get_contents($destination, false, $requetePost);

    
}



if (!empty($_POST['nomUtilisateur']) and !empty(filter_input(INPUT_POST, "courriel", FILTER_VALIDATE_EMAIL)) and !empty($_POST['mdp'])){

    require_once __DIR__."/../db/repository/Insert/InsertUtilisateur.classe.php";
    require_once __DIR__."/../db/repository/Select/SelectUtilisateur.classe.php";


    // Récupérer les informations
    $nomUtilisateur = filter_input(INPUT_POST, "nomUtilisateur", FILTER_DEFAULT);
    $courriel = filter_input(INPUT_POST, "courriel", FILTER_VALIDATE_EMAIL);
    $mdp = filter_input(INPUT_POST, "mdp", FILTER_DEFAULT);


    // Vérifier si le courriel existe déjà dans la base de données
    $requeteRechercheCourriel = new SelectUtilisateur($courriel);

    if (empty($requeteRechercheCourriel->select())){

        // Hasher le mdp
        $secureMdp = password_hash($mdp, PASSWORD_DEFAULT);

        // Requête pour créer l'utilisateur
        $requeteCreerUtilisateur = new InsertUtilisateur();
        $requeteCreerUtilisateur->setParams($nomUtilisateur, $courriel, $secureMdp);


        if ($requeteCreerUtilisateur->insert()){
            // Rediriger vers la page d'authentification
            RedirigerAuth($courriel, $mdp);
            
        }
        else{
            error_log("[".date("d/m/o H:i:s e",time())."] Utilisateur n'a pas été créé correctement: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/storeconfig.acces.log");
            header("Location: ../../erreur/erreur.php");
        }

    }
    else{
        error_log("[".date("d/m/o H:i:s e",time())."] Le courriel est déjà utilisé pour un autre utilisateur: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/storeconfig.acces.log");
        header("Location: ../../erreur/erreur.php");
    }
    
}
    
else{
    
    // Si je n'ai pas le nom d'utilisateur, le courriel ou le mot de passe
    error_log("[".date("d/m/o H:i:s e",time())."] Authentification anormal - nom d'utilisateur, mail ou mdp absent: Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/storeconfig.acces.log");
    header("Location: ../../erreur/erreur.php");
}


?>