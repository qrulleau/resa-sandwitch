<?php

function checkPassword($password){
  global $validation,$error;

  $specialCharacter = "(<|>|'|\"|[|]|!|@|%|&|%|\^|\*)";
  $number = "(1|2|3|4|5|6|7|8|9|0)";
  $checkPass = false;
  
}
/** Fonction de vérification des charactères du formulaires **/
function verifyInput($var)
{
    $var = htmlentities($var);
    $var = trim($var);
    $var = strip_tags($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

/** Fonction de vérification du droit de l'utilisateur **/
function verifID()
{
  if(!isset($_SESSION['ident']))
    {
        header("Location: formulaireCo.php");
        exit();
    }
}
      
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
  $querie = 'select * FROM accueil';
  $statement = $databaseConnexion->prepare($querie);
  $statement->execute();
  $projects = $statement->fetchAll();
}
function displayUtilisateurPage(){
  global $databaseConnexion,$utilisateurs;
  $querie = 'select * from utilisateur';
  $statement = $databaseConnexion->prepare($querie);
  $statement->execute();
  $utilisateurs = $statement->fetchAll();
}
function displayActualPage(){
  global $databaseConnexion,$projects;

  $id = $_GET['id'];
  $querie = 'select * from accueil where id_accueil = ?';
  $statement = $databaseConnexion->prepare($querie);
  $statement->execute(array($id));
  $projects = $statement->fetchAll();
}
function checkUser() {
  global $databaseConnexion;
  $querie = 'select * from utilisateur where email_user';
  $statement = $databaseConnexion->prepare($querie);
  $statement->execute();

}
function UpdateIndexPage(){
  global $databaseConnexion,$uploadResult;

  $id = $_GET['id'];
  $text_accueil = $_POST['text_accueil'];
  $lien_pdf = $_POST['lien_pdf'];


  if (isset($text_accueil)) {
    $querie = 'update accueil set texte_accueil = ?, lien_pdf = ? where id_accueil = ? ';
    $statement = $databaseConnexion->prepare($querie);
    $statement->execute(array($text_accueil,$lien_pdf,$id));

    $target_dir = "";
    $file = $_FILES['lien_pdf']['name'];
    $path = pathinfo($file);
    $filename = $path['filename'];
    $ext = 'pdf';
    $temp_name = $_FILES['lien_pdf']['tmp_name'];
    $path_filename_ext = $target_dir.$filename.".".$ext;

    if (file_exists($path_filename_ext)) {
      $uploadResult = "Sorry, file already exists.";
      }else{
      move_uploaded_file($temp_name,$path_filename_ext);
      $uploadResult = "Congratulations! File Uploaded Successfully.";
      }


  }


  
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
      header('location: http://localhost/resa-sandwitch/views/backoffice/user/backoffice.php');
      session_start();
      $_SESSION['ident'] = $id;
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
      header('location: http://localhost/resa-sandwitch/views/backoffice/admin/backoffice.php');
      session_start();
    } else {
      echo 'mauvais login ou mot de passe';;
    }

  }
}