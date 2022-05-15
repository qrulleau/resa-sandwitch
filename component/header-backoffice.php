<?php
  global $databaseConnexion,$utilisateurs;
  $querie = 'select * from utilisateur';
  $statement = $databaseConnexion->prepare($querie);
  $statement->execute();
  $utilisateurs = $statement->fetchAll();
?>

<header class="backoffice">
  <div class="d-flex column align-start">
  <div class="logo t-center">
<<<<<<< HEAD
        <img src="http://localhost/projetFinal/assets/logo.png" alt="">
=======
        <img src="http://localhost/resa-sandwitch/assets/logo.png" alt="">
>>>>>>> 3a6b9fe2cc11732d219d3fb6b0d785f66b504e46
        <h1 class="playfair">Lycée Saint-Vincent</h1>
        <p>Enseignement secondaire & supérieur</p>
      </div>
      <a href="http://localhost/resa-sandwitch/">Accueil</a>
      <?php
        echo "<a class='remove' href='http://localhost/resa-sandwitch/views/backoffice/user/reservIndivi.php?id=" . $utilisateurs[0]['id_user'] . "'>Commander</a>"
      ?>
    <a href="http://localhost/resa-sandwitch/database/processing/deconnexion.php">Se deconnecter</a>
  </div>
</header>