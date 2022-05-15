<?php 

require (__DIR__ . '../../../../database/connexion.php');
require (__DIR__ . '../../../../database/querie/querie.php');

displayUtilisateurPage();

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
  <title>Document</title>
  <link rel="stylesheet" href="../../../style/main.css">
  <style>
    .backoffice .container {
      margin-top: 60px;
    }
  </style>
</head>
<body class="backoffice user">
  <div class="d-flex align-start">
    <?php require (__DIR__ . '../../../../component/header-backoffice.php'); ?>

    <div class="container">
      <a href="../../../database/processing/user-backoffice.php/insert.php">Ajouter un utilisateur</a>
      <div class="header-tab white">
        <div class="d-flex t-center">
          <div class="col id_accueil">
            <p>id_user</p>
          </div>
          <div class="col texte_accueil">
            <p>role_user</p>
          </div>
          <div class="col lien_pdf">
            <p>email_user</p>
          </div>
          <div class="col action">
            <p>prenom_user</p>
          </div>
          <div class="col action">
            <p>nom_user</p>
          </div>
          <div class="col action">
            <p>action</p>
          </div>
        </div>
      </div>
      <div class="body-tab t-center">
        
        <?php 
          foreach ($utilisateurs as $utilisateur) {
        ?>
        <div class="d-flex border">
          <div class="col id_accueil">
            <p><?php echo $utilisateur['id_user'] ?></p>
          </div>
          <div class="col texte_accueil">
            <p><?php echo $utilisateur['role_user'] ?></p>
          </div>
          <div class="col lien_pdf">
            <p><?php echo $utilisateur['email_user'] ?></p>
          </div>
          <div class="col lien_pdf">
            <p><?php echo $utilisateur['prenom_user'] ?></p>
          </div>
          <div class="col lien_pdf">
            <p><?php echo $utilisateur['nom_user'] ?></p>
          </div>
          <div class="col action">
            <div class="d-flex justify-center">
            <?php
            echo "<a class='remove' href='../../../database/processing/admin-backoffice/update.php?id=" . $user['id_accueil'] . "'>Modifier</a>"
            ?>
            <?php
            echo "<a class='remove' href='../../../database/processing/admin-backoffice/deleting.php?id=" . $user['id_accueil'] . "'>Supprimer</a>"
            ?>
            </div>
          </div>
        </div>
        <?php
          }
        ?>
        </div>
      </div>
    </div>
  <script src="../../script/main.js"></script>
</body>
</html>