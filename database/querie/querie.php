<?php

function signinUser() {
  global $databaseConnexion;

  $firstName = $_GET['firstName'];
  $lastName = $_GET['lastName'];
  $email = $_GET['email'];
  $password = $_GET['password'];

  if (isset($firstName,$lastName,$lastName,$email,$password)) {
    $querie = 'insert into utilisateur (nom_user,prenom_user,password_user,email_user,role_user,active_user) values (?,?,?,?,?,?)';
    $statement = $databaseConnexion->prepare($querie);
    $statement->execute(array($lastName,$firstName,$email,$password,'a',1));
  }

  
}

// function checkPassword(password){
//   $specialCharacter = [[,!,@,[,$,%,^,&,*,(,),_,+,\,-,=,\,[,\,],{,},;,',:,",\,\,|,,,.,<,>,\,/,?,],+,/]'
// }

function displayHomePage() {
  global $databaseConnexion,$projects;
  $querie = 'select * FROM  accueil';
  $statement = $databaseConnexion->prepare($querie);
  $statement->execute();
  $projects = $statement->fetchAll();
}
function authentification (){

  global $databaseConnexion;

  $password = $_POST['password'];
  $email = $_POST['email'];

  if (isset($password,$email)) {
    $querie = 'select * from utilisateur where email_user = ? and password_user = ? limit 1';
    $statement = $databaseConnexion->prepare($querie);
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $statement->execute(array($email, $password));
    $user = $statement->fetchAll();

    if (count($user) == 0){
      echo "mauvais login ou mot de passe";
    } else {
      header('location: backoffice/backoffice.php');
      session_start();
    }
  }
}
