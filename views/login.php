<?php
  require '../database/connexion.php';
  require '../database/querie/querie.php';
  displayAllProject();
  var_dump($projects)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&family=Poppins:wght@200;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../style/main.css">
  <title>Document</title>
</head>
<body>
  <?php require '../component/header.php' ?>

  <div class="d-flex container login">
    <div class="t-center connexion">
      <h2>Connectez-vous</h2>
      <form action="">
        <div class="d-flex column">
          <label for="">Email :</label>
          <input type="text" name="" id="" >
        </div>
        <div class="d-flex column">
          <label for="">Mot de passe :</label>
          <input type="text" name="" id="">
        </div>
        <input type="submit" value="Se connecter">
      </form>
    </div>
    <div class="t-center">
      <h2>Pas encore de compte ?</h2>
      <p>Vous etes eleves ou personnel de l'etablissement et vous n'avez pas encore de compte sur la plateforme ?</p>
      <a href="inscription.php">Acceder au formulaire d'inscription</a>
    </div>
  </div>

  <?php require '../component/footer.php' ?>
</body>
</html>