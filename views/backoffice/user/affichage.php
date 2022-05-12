<!DOCTYPE html>
<html>
    <head>
      <title>Afficher un utilisateur</title>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://kit.fontawesome.com/568733c487.js" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
      <link rel="stylesheet" href="/style/affichage.css">
    </head>
    
    <body>
      <h1 class="text-logo"><i class="fa-solid fa-user"></i>Gestion des utilisateurs<i class="fa-solid fa-user"></i></h1>
      <div class="container admin">
        <div class="row">
          <div class="col-md-6">
            <h1 class="container-fluid titre"><strong>Voir tous les utilisateurs</strong></h1>
            <br>
            <?php

              require '../connexion.php';
              $statement = $db->query("SELECT * FROM utilisateur");
              while ($item = $statement->fetch())
              {
                echo "<div class='test2'>";
                // Affichage des données de la BDD dans le tableau à modifier ou supprimer
                  echo "<div class='affichage'>";
                      echo "<p>" . $item['id_user'] . "</p>";
                      echo "<p>" . $item['role_user'] . "</p>";
                      echo "<p>" . $item['email_user'] . "</p>";
                      echo "<p>" . $item['password_user'] . "</p>";
                      echo "<p>" . $item['nom_user'] . "</p>";
                      echo "<p>" . $item['prenom_user'] . "</p>";
                      echo "<p>" . $item['active_user'] . "</p>";
                  echo "</div>"; 
                echo "</div>";
              }
            ?>
            <br>
            <div class="form-actions">
              <a type="submit" class="btn btn-success" href="/database/processing/user-backoffice.php/insert.php" target=_blank><span class="bi-plus"></span> Ajouter</a>
              <a type="submit" class="btn btn-danger" href="/database/processing/user-backoffice.php/modif.php" target=_blank><span class="bi-pencil"></span> Modifier</a>
              <a type="submit" class="btn btn-warning" href="/views/backoffice/user/index.html" target=_blank><span class="bi-trash"></span> Supprimer</a>
              <a class="btn btn-primary" href="index.php" target=_blank><span class="bi-arrow-left"></span> Retour</a>
            </div>
          </div>
        </div>
      </div>   
    </body>
</html>

