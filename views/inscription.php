<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../style/main.css">
</head>
<body>
  <?php require '../component/header.php' ?>
  <div class="container signin">
    <div class="t-center">
      <h2>Inscription</h2>
      <h3>Inscrivez vous des maintenant pour pouvoir vous connecter.</h3>
    </div>
    <form action="">
      <div class="d-flex">
        <div>
          <div class="d-flex column align-start">
            <label for="">Votre prenom</label>
            <input type="text">
          </div>
          <div class="d-flex column align-start">
            <label for="">Votre nom</label>
            <input type="text">
          </div>
          <div class="d-flex column align-start">
            <label for="">Votre email</label>
            <input type="text">
          </div>
          <div class="d-flex column align-start">
            <label for="">Votre date de naissance :</label>
            <input type="email">
          </div>
        </div>
        <div>
          <div class="d-flex column align-start">
            <label for="">Votre mot de passe</label>
            <input type="text">
          </div>
          <div class="d-flex column align-start">
            <label for="">Confirmer votre mot de passe</label>
            <input type="text">
          </div>
        </div>
      </div>
      <div class="t-center">
        <div class="d-flex justify-center">
          <input type="submit" value="S'inscrire">
          <a href="#">Revenir au formulaire de connexion</a>
        </div>
      </div>
    </form>
  </div>
  <?php require '../component/footer.php' ?>
</body>
</html>