<?php
// function checkPassword($password){
//   global $validation;
//   if (strlen($password) >= 8) {
//     if (preg_match("1234567890",$password)){
//       if (preg_match("/^\w*(?=\w*\d)(?=\w*[A-Z])(?=\w*[^0-9A-Za-z])(?=\w*[a-z])\w*$/", $password)) {
//         // echo "votre mot de passe est valie";
//         $validation = "votre mot de passe est valide";
//       } else {
//         echo "votre mot de passe est invalide";
//         $validation = "votre mot de passe n'a pas de caracteres speciale ou un numero ou n'est pas assez long, minimum 8 caracteres";
//         die();
//       }
//     }
//   }
// }

// session_start()

// $user = ;
// $prenom = $_SESSION['nomImput'];
// $mdp = $_SESSION['mdp'];

// $user = $_SESSION['user'];
// $prenom = $_SESSION['prenom'];
// $mdp = $_SESSION['mdp'];



function checkPassword($password){
  global $validation,$error;

  $specialCharacter = "(<|>|'|\"|[|]|!|@|%|&|%|\^|\*)";
  $number = "(1|2|3|4|5|6|7|8|9|0)";
  $checkPass = false;

      
}
function signinUser() {
  global $databaseConnexion,$validation,$error;

  $specialCharacter = "(<|>|'|\"|[|]|!|@|%|&|%|\^|\*)";
  $number = "(1|2|3|4|5|6|7|8|9|0)";

  $firstName = $_GET['firstName'];
  $lastName = $_GET['lastName'];
  $email = $_GET['email'];
  $password = $_GET['password'];

  

  if (isset($firstName,$lastName,$email,$password)) {

    if (!preg_match($number,$password)){
      $error = 'votre mot de passe doit avoir au moins un nombre';
    }

    if (!preg_match($specialCharacter,$password)){
      $error = $error . "<br>votre mot de passe doit avoir un caractere special";
    }
    if (strlen($password) < 8){
      $error = $error . "<br> votre mot de passe doit faire au moins 8 caracteres";
    }
    else {
      $validation = 'votre mot de passe est valide';

      $password = password_hash($password, PASSWORD_ARGON2ID);

      $querie = 'insert into utilisateur (nom_user,prenom_user,password_user,email_user,role_user,active_user) values (?,?,?,?,?,?)';
      $statement = $databaseConnexion->prepare($querie);
      $statement->execute(array($lastName,$firstName,$password,$email,'e',1));
    }
  }
}

function displayHomePage() {
  global $databaseConnexion,$projects;
  $querie = 'select * FROM  accueil';
  $statement = $databaseConnexion->prepare($querie);
  $statement->execute();
  $projects = $statement->fetchAll();
}
function checkUser() {
  global $databaseConnexion;
  $querie = 'select * from utilisateur where email_user';
  $statement = $databaseConnexion->prepare($querie);
  $statement->execute();

}
function authentification (){

  global $databaseConnexion;

  $password = $_POST['password'];
  $email = $_POST['email'];

  if (isset($password,$email)) {

    // var_dump($password,$email);
    $querie = 'select * from utilisateur where email_user = ? limit 1';
    $statement = $databaseConnexion->prepare($querie);
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    // var_dump($password);
    $statement->execute(array($email));
    $user = $statement->fetchAll();

    $user_password = $user[0]['password_user'];


    if (password_verify($password,$user_password)) {
      header('location: backoffice/backoffice.php');
      session_start();
    } else {
      echo 'mauvais login ou mot de passe';;
    }

  }
}
function authentificationAdmin (){

  global $databaseConnexion;

  $password = $_POST['password'];
  $email = $_POST['email'];

  if (isset($password,$email)) {

    $querie = 'select * from utilisateur where email_user = ? limit 1';
    $statement = $databaseConnexion->prepare($querie);
    $statement->setFetchMode(PDO::FETCH_ASSOC);;
    $statement->execute(array($email));
    $user = $statement->fetchAll();

    $password_user = $user[0]['password_user'];
    $role_user = $user[0]['role_user'];


    if (password_verify($password,$password_user) && $role_user == 'a') {
      header('location: backoffice/backoffice.php');
      session_start();
    } else {
      echo 'mauvais login ou mot de passe';;
    }

  }
}