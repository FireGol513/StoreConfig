<?php

require_once __DIR__."/../session/SessionFinale.include.php";


$session = new SessionFinale();
session_start();
$session->supprimer();
header("Location: ../../index.php");

?>