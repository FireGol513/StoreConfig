<?php

require_once __DIR__."/Session.abstract.php";
require_once __DIR__."/../../../../.cfgStoreConfig/config.bd.include.php";



class Session2FA extends Session
{
    /**
     * Initialise les paramètres de session.
     */
    public function __construct()
    {   
        ini_set("session.cookie_lifetime", DUREE_SESSION_2FA); // Durée de la session en secondes     
        session_name("2FA");
        parent::__construct();      
    }


    /**
     * Affecte les valeurs nécessaires à la validation de la session complète.
     */
    public function setSession(string $nomUtilisateur, ?string $courriel)
    {
        $_SESSION["courriel"] = $courriel;
        $_SESSION["nomUtilisateur"] = $nomUtilisateur;
        $_SESSION["delai"] = time();
    }


    /**
     * Récupère la session active et vérifie la validité avec les variables $_SESSION
     */
    public function validerSession()
    {
        try 
        {
            if (session_status() == PHP_SESSION_ACTIVE){
                
                if (!isset($_SESSION['courriel']) || !isset($_SESSION['nomUtilisateur']) || !isset($_SESSION['delai']))
                {
                    $this->supprimer();
                    error_log("[".date("d/m/o H:i:s e",time())."] Accès directe refusée au requérant ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/storeconfig.acces.log");
                    // header("Location: ./../erreur/erreur.php");
                    exit();

                } elseif ((time() - $_SESSION['delai']) > DUREE_SESSION_2FA) {
                    $this->supprimer();
                    error_log("[".date("d/m/o H:i:s e",time())."] Session expirée : Requérant ".$_SERVER['REMOTE_ADDR']."Client authorisé: ".$_SESSION['courriel']."\n\r" ,3, __DIR__."/../../../../logs/storeconfig.acces.log");
                    header("Location: ./../erreur/erreur.php");
                    exit();
                    
                }

            } else {
                echo "session inactive";
            }
        } catch (Exception $e) {
            error_log("Erreur sur la session: ".$e->getMessage());
        }
        
    }



    /**
     * Supprime la session active et antidate le cookie.
     */
    public function supprimer()
    {
        // Une session doit être active et ce doit être la même session que celle qui est à détruire

        if (session_status() == PHP_SESSION_ACTIVE){

            $parametresSession = session_get_cookie_params(); //Pour antidater (détruire) le cookie

            setcookie(
                session_name(), '', time()-60*60*24*30,
                $parametresSession["path"], $parametresSession["domain"],
                $parametresSession["secure"], $parametresSession["httponly"]
            );

            session_destroy(); //La session est effacée
            $_SESSION = array(); //La variable superglobale est supprimée
        }
    }
}


