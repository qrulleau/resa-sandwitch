<?php 

require '../../connexion.php';
require '../../querie/querie.php';
displayActualPage();
UpdateIndexPage();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../style/main.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital@1&display=swap" rel="stylesheet"> 
  <title>Document</title>
</head>
<body class="backoffice update">
  <div class="d-flex align-start">
    <?php require (__DIR__ . '../../../../component/header-backoffice.php'); ?>

    <div class="container">
    <h2 class="t-center">Modifier</h2>

    <form method="post">
      <div class="d-flex">
        <div>
          <div class="d-flex column align-start">
            <label for="text_accueil">Texte d'accueil :</label>
            <input type="text" name="text_accueil" id="text_accueil" value="<?php echo $projects[0]['texte_accueil']?>">
          </div>
          <div class="d-flex column align-start">
            <label>PDF :</label>
            <p><?php echo $projects[0]['lien_pdf']?></p>
          </div>
          <div class="d-flex column align-start">
            <label for="lien_pdf">Selectionner un PDF</label>
            <input type="file" name="lien_pdf" id="lien_pdf" enctype="multipart/form-data">
          </div>
        </div>
        <div>
          <h3 class="t-center">Programme de la sansdwicherie :</h3>
          <embed src="<?php echo '../../../assets/'. $projects[0]['lien_pdf']?>" width="410" height="274" type="application/pdf">
        </div>
      </div>
      <p class="t-center"><?php echo $uploadResult?></p>
      <div class="d-flex justify-center">
        <input type="submit" value="Modifier" class="empty">
        <a href="../../../views/backoffice/admin/backoffice.php" class="full">Retour au backoffice</a>
      </div>

    </form>
    </div>
  </div>
  <script src="../../script/main.js"></script>
</body>
</html>