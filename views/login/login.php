<?php
  require (__DIR__ . '../../../database/connexion.php');
  require (__DIR__ . '../../../database/querie/querie.php');

  authentification();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital@1&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="../../style/main.css">
  <title>Document</title>
</head>
<body>
  <?php require '../../component/header.php' ?>

  <div class="background">
    <div class="login">
      <div class="container">
        <div class="d-flex">
          <div class="white t-center">
            <h2>Vous n'avez pas de compte ?</h2>
            <a class="empty white border-width" href="../inscription.php">Inscription</a>
          </div>
          <div>
            <div class="card t-center">
              <h2>Se connecter</h2>
              <div class="span"></div>
              <form method="post" class="d-flex column">
                <input type="text" name="email" id="email" placeholder="Votre adresse e-mail">
                <input type="password" name="password" id="password" placeholder="Votre mot de passe">
                <a href="login-admin.php" class="underline">connexion en tant qu'administrateur</a>
                <input class="full" type="submit" value="Connexion">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require '../../component/footer.php' ?>
</body>
</html>