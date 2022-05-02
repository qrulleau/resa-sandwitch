<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/main.css">
  <title>Document</title>
</head>
<body>
  <?php require '../component/header.php' ?>

  <div class="d-flex">
    <div>
      <h2>Connectez-vous</h2>
      <form action="">
        <div>
          <label for="">Email</label>
          <input type="text" name="" id="" >
        </div>
        <div>
          <label for="">mot de passe</label>
          <input type="text" name="" id="">
        </div>
        <input type="submit" value="Se connecter">
      </form>
    </div>
    <div>
      <h2>Pas encore de compte ?</h2>
      <p>Vous etes eleves ou personnel de l'etablissement et vous n'avez pas encore de compte sur la plateforme ?</p>
    </div>
    <a href="inscription.php">Acceder au formulaire d'inscription</a>
  </div>

  <?php require '../component/footer.php' ?>
</body>
</html>