<?php

/**
 * Dépendances
 */
require_once __DIR__."/../Connexion.classe.php";


abstract class Insert
{
    protected PDO $connexion;

    public function __construct()
    {
        $connexion = new Connexion();
        $this->connexion = $connexion->getConnexionBdEcrire();
    }

    /**
     * Signature de la fonction d'insertion d'un enregistrement.
     */
    abstract function insert();

}