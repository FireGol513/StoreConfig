<?php

require_once __DIR__."/Session.abstract.php";
require_once __DIR__."/../../../../.cfgStoreConfig/config.bd.include.php";



class SessionFinale extends Session
{
    /**
     * Initialise les paramètres de session.
     */
    public function __construct()
    {   
        ini_set("session.cookie_lifetime", DUREE_SESSION_FINAL); // Durée de la session en secondes     
        session_name("ConnecteFinal");
        parent::__construct();      
    }


    /**
     * Affecte les valeurs nécessaires à la validation de la session complète.
     */
    public function setSession(string $nomUtilisateur, ?string $courriel = NULL, ?int $idUtilisateur)
    {
        $_SESSION["ip"] = $_SERVER["REMOTE_ADDR"];
        $_SESSION["idUtilisateur"] = $idUtilisateur;
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
                
                if (!isset($_SESSION['nomUtilisateur']) || !isset($_SESSION['ip']) || !isset($_SESSION['delai']) || !isset($_SESSION['idUtilisateur']))
                {
                    $this->supprimer();
                    error_log("[".date("d/m/o H:i:s e",time())."] Accès directe refusée au requérant Session2FA".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../../logs/acces-refuses.log");
                    header("Location: /storeconfig/erreur/erreur.php?erreur=nonAuth");
                    exit();

                } elseif ((time() - $_SESSION['delai']) > DUREE_SESSION_FINAL) {
                    $this->supprimer();
                    error_log("[".date("d/m/o H:i:s e",time())."] SessionFinale expirée : Requérant ".$_SERVER['REMOTE_ADDR']."Client authorisé: ".$_SESSION['nomUtilisateur']."\n\r" ,3, __DIR__."/../../../../logs/acces-refuses.log");
                    header("Location: /storeconfig/erreur/erreur.php?erreur=delaiDepasse");
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


