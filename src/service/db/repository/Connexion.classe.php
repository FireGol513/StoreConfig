<?php

require_once __DIR__."/../../../../../.cfgStoreConfig/config.bd.include.php"; // Extérieur au dossier public:  /home/user/cfgStoreConfig

class Connexion
{
    /** Retourne une connexion avec le driver Mariabd sur la bd en lecture. */
    function getConnexionBdLire()
    {
        try {
            $chaineConnexion = "mysql:dbname=".BDSCHEMA.";host=".BDSERVEUR;

            return new PDO($chaineConnexion,USERLIRE,MDPUSERLIRE);

        } catch (Exception $e) {
            error_log("Exception pdo: ".$e->getMessage());
        }

    }

    function getConnexionBdEcrire()
    {
        try {
            $chaineConnexion = "mysql:dbname=".BDSCHEMA.";host=".BDSERVEUR;

            return new PDO($chaineConnexion,USERECRIRE,MDPUSERECRIRE);

        } catch (Exception $e) {
            error_log("Exception pdo: ".$e->getMessage());
        }

    }
}
