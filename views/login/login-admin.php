<?php
  require (__DIR__ . '../../../database/connexion.php');
  require (__DIR__ . '../../../database/querie/querie.php');

  authentificationAdmin();
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
        <div class="d-flex justify-center">
            <div class="card t-center admin">
              <h2>Connexion administrateur</h2>
              <div class="span"></div>
              <form method="post" class="d-flex column">
                <input type="text" name="email" id="email" placeholder="votre adresse email">
                <input type="text" name="password" id="password" placeholder="votre mot de passe">
                <p class="t-center error"><?php echo $loginAdminError?></p>
                <a href="login.php" class="underline">connexion en tant qu'utilisateur</a>
                <input class="full" type="submit" value="connexion">
              </form>
            </div>
        </div>
    </div>
  </div>

  <?php require '../../component/footer.php' ?>
</body>
</html>