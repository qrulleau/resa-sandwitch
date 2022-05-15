<?php
  require (__DIR__ . '../../env.php');
  // require '../env.php';

try {
  global $databaseConnexion; 
  $databaseConnexion = new PDO("mysql:host={$server};dbname={$database}",$user,$pass);
} catch (PDOException $e) {
  echo 'There is an errror' . $e->getMessage();
}