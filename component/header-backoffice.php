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
        <img src="http://localhost/resa-sandwitch/assets/logo.png" alt="">
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