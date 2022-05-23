<?php

    require '../projetFinal/database/connexion.php';
    require (__DIR__ . '../../env.php');

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // supprimer un utilisateur
    $sql = "DELETE FROM utilisateur WHERE id_user=1";

    // message de confirmation pour la suppression de l'utilisateur
    $conn->exec($sql);
    echo "Record deleted successfully";

    $conn = null;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Suppression d'un utilisateur</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    
    <body>
        <div class="container admin">
            <div class="row">
                <h1><strong>Supprimer un utilisateur</strong></h1>
                <br>
                <form class="form" action="delete.php" role="form" method="post">
                    <br>
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <p class="alert alert-warning">Etes vous sur de vouloir supprimer cet utilisateur ?</p>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-warning">Oui</button>
                      <a class="btn btn-secondary" href="index.php">Non</a>
                    </div>
                </form>
            </div>
        </div>   
    </body>
</html>

