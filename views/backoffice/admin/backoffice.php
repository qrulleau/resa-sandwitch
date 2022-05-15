<?php 

require (__DIR__ . '../../../../database/connexion.php');
require (__DIR__ . '../../../../database/querie/querie.php');


displayHomePage();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:ital@1&display=swap" rel="stylesheet"> 
  <title>Document</title>
  <link rel="stylesheet" href="../../../style/main.css">
</head>
<body class="backoffice">
  <div class="d-flex align-start">
    <?php require (__DIR__ . '../../../../component/header-backoffice.php'); ?>

    <div class="container">
      <div class="header-tab white">
        <div class="d-flex t-center">
          <div class="col id_accueil">
            <p>id_accueil</p>
          </div>
          <div class="col texte_accueil">
            <p>Texte accueil</p>
          </div>
          <div class="col lien_pdf">
            <p>Lien PDF</p>
          </div>
          <div class="col action">
            <p>Action</p>
          </div>
          
        </div>
      </div>
      <div class="body-tab t-center">
        
        <?php 
          foreach ($projects as $project) {
        ?>
        <div class="d-flex border">
          <div class="col id_accueil">
            <p><?php echo $project['id_accueil'] ?></p>
          </div>
          <div class="col texte_accueil">
            <p><?php echo $project['texte_accueil'] ?></p>
          </div>
          <div class="col lien_pdf">
            <p><?php echo $project['lien_pdf'] ?></p>
          </div>
          <div class="col action">
            <div class="d-flex justify-center">
            <?php
            echo "<a class='remove' href='../../../database/processing/admin-backoffice/update.php?id=" . $project['id_accueil'] . "'>Modifier</a>"
            ?>
            <?php
            echo "<a class='remove' href='../../../database/processing/admin-backoffice/deleting.php?id=" . $project['id_accueil'] . "'>Supprimer</a>"
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