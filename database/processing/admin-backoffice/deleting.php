<?php

require '../../connexion.php';
global $databaseConnexion;
$id = $_GET['id'];
$querie = 'DELETE FROM accueil where id_accueil = ?';
$statement = $databaseConnexion->prepare($querie);
$statement->execute(array($id));
var_dump($id);
header("location: ../../../views/backoffice/user/backoffice.php");

