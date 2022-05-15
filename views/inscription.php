<?php


require '../database/connexion.php';
require '../database/querie/querie.php';
global $validation;
session_start();

$firstNameInput = $_GET['firstName'];
$lastNameInput = $_GET['lastName'];
$passwordInput = $_GET['password'];
$emailInput = $_GET['email'];

signinUser();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:ital@1&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="../style/main.css">
</head>
<body>
  <?php require '../component/header.php' ?>

  <div class="d-flex align-start justify-start">
    <img src="../assets/inscription.jpg" alt="">
    <div class="signin">
      <h2>Inscription</h2>
      <form method="get">
        <div class="d-flex column align-start">
          <label for="firstName">Votre prenom</label>
          <input type='firstName' id='firstName' name='firstName' value="<?php echo $firstNameInput?>" placeholder="Bernard">
        </div>
        <div class="d-flex column align-start">
          <label for="lastName">Votre nom</label>
          <input type='lastName' id='lastName' name='lastName' value="<?php echo $lastNameInput?>" placeholder="Julien">
        </div>
        <div class="d-flex column align-start">
          <label for="email">Votre email</label>
          <input type="text" id="email" name="email" value="<?php echo $emailInput?>"  placeholder="bernard.julien@gmail.com">
        </div>
        <div class="d-flex column align-start">
          <label for="password">Votre mot de passe</label>
          <input type='password' id='password' name='password' value="<?php echo $passwordInput?>" placeholder="mon mot de passe">
          <p><?php echo $validation?></p>
          <p class="error"><?php echo $error?></p>
        </div>
        <div class="d-flex call-to-action justify-start">
          <input type="submit" class="empty" value="je m'inscris">
          <a class="full" href="login/login.php">retour a l'accueil</a>
        </div>
      </form>
    </div>
    
  </div>
  <?php require '../component/footer.php' ?>
</body>
</html>