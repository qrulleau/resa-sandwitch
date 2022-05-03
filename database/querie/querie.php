<?php

function displayAllProject() {
  global $databaseConnexion,$projects;
  $querie = 'select * FROM  accueil';
  $statement = $databaseConnexion->prepare($querie);
  $statement->execute();
  $projects = $statement->fetchAll();
}
