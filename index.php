<?php

require 'database/connexion.php';
require 'database/querie/querie.php';
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <title>Document</title>
    <link rel="stylesheet" href="style/main.css">
      <!-- CSS only -->
  </head>
  <body>
    <?php require 'component/header.php'?>
    <div class="homePage">
      <h2 class="t-center">Bienvenue sur la sandwicherie du<br>lycee st-vincent</h2>
      <div class="container">
        <div class="d-flex">
          <div>
            <p><?php echo $projects[0]['texte_accueil']?></p>
            <div class="d-flex call-to-action">
              <a class="empty" href="">commander</a>
              <button class="full cafeteria">menu de la cantine</button>
            </div>
            <div class="planning">
              <h3>informations</h3>
              <p>Du lundi au dimanche, de 12h30 à 13h30</p>
              <p>Rez-de-chaussée du batiment Saint-Louis</p>
              <p>Sandwichs faits sur place par nos chefs / à emporter/  formule déjeuner</p>
            </div>
          </div>
          <div>
            <img src="assets/accueil.jpg" class="shadow" alt="">
            <?php echo "<img src='assets/{$projects[0]["lien_pdf"]}' alt=''>" ?>

          </div>
        </div>
      </div>
    </div>

    <?php require 'views/histoCommandes.php'?>
    
    <?php require 'component/footer.php'?>

    <div class="modal-cafeteria d-flex justify-center display-none">
      <div class="background-color">
        <div class="relative-position">
        <embed src="assets/menu.pdf" width="1300" height="850px" type="application/pdf">
          <div class="absolute-position">
            <img src="assets/icon/cancel.svg" class="cancel" alt="">
          </div>
        </div>
      </div>
    </div>

    <script src="script/main.js"></script>
  </body>
</html>