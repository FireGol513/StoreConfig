<?php

require_once __DIR__.'/db/repository/Select/SelectModeles.classe.php';

$json = file_get_contents('php://input');

$jsonClean = filter_var($json, FILTER_DEFAULT);


if (!empty($jsonClean)){

    $jsonClean = json_decode($jsonClean, true);
    if ($jsonClean["demande"] == "all"){

        $selectModeles = new SelectModeles();
        $modeles = $selectModeles->selectMultiple();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($modeles);
    }

}






?>